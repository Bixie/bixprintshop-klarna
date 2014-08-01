<?php
/* *
 *	Bixie Printshop
 *  ogonehelper.php.php
 *	Created on 31-7-14 9:58
 *  
 *  @author Matthijs
 *  @copyright Copyright (C)2014 Bixie.nl
 *
 */

// No direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/src/Klarna.php';
// Dependencies from http://phpxmlrpc.sourceforge.net/
require_once dirname(__FILE__) .
	'/src/transport/xmlrpc-3.0.0.beta/lib/xmlrpc.inc';
require_once dirname(__FILE__) .
	'/src/transport/xmlrpc-3.0.0.beta/lib/xmlrpc_wrappers.inc';


/**
 * Class BixKlarnahelper
 */
class BixKlarnahelper {

	/**
	 * @var string Merchant ID
	 */
	protected $_eid;

	/**
	 * @var string Shared secret
	 */
	protected $_sharedSecret;

	/**
	 * @var bool servertype
	 */
	protected $_server;

	/**
	 * @var string
	 */
	protected $transaction_id;

	/**
	 * @param string $transaction_id
	 * @throws BixKlarnaExeption
	 */
	function __construct ($transaction_id) {
		$this->transaction_id = $transaction_id;
		$this->_eid = BixTools::config('algemeen.betalen.bix_klarna.eid', '');
		$this->_sharedSecret = BixTools::config('algemeen.betalen.bix_klarna.sharedSecret', '');
		$testSetting = BixTools::config('algemeen.betalen.bix_klarna.test', 0);
		$this->_server = !empty($testSetting) ? Klarna::BETA : Klarna::LIVE;
//		Klarna::$debug = true;
		if (empty($this->_eid) || empty($this->_sharedSecret) || empty($this->transaction_id)) {
			throw new BixKlarnaExeption(JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_BETAALINFO_INCOMPLEET'));
		}
	}

	/**
	 * @return Klarna
	 */
	protected function _getKlarna () {
		$k = new Klarna();
		$k->config(
			$this->_eid, // Merchant ID
			$this->_sharedSecret, // Shared secret
			KlarnaCountry::NL, // Purchase country
			KlarnaLanguage::NL, // Purchase language
			KlarnaCurrency::EUR, // Purchase currency
			$this->_server, // Server
			'json', // PClass storage
			'./pclasses.json' // PClass storage URI path
		);
		return $k;
	}

	/**
	 * @param array $checkoutData
	 * @throws BixKlarnaExeption
	 * @return string html form
	 */
	public function doSetup ($checkoutData) {
		$k = $this->_getKlarna();

		foreach ($checkoutData['orders'] as $order) {
			$k->addArticle(
				$order['quantity'], // Quantity
				$order['sku'], // Article number
				$order['name'], // Article name/title
				$order['price'], // Price
				$order['vat'], // 25% VAT
				$order['discount'], // Discount
				$order['flags'] // Price is including VAT.
			);
		}
		$adresData = $checkoutData['bill_address'];
		$addr = new KlarnaAddr(
			$adresData['email'], // Email address
			$adresData['telefoon'], // Telephone number, only one phone number is needed
			$adresData['mobiel'], // Cell phone number
			$adresData['voornaam'], // First name (given name)
			$adresData['achternaam'], // Last name (family name)
			'', // No care of, C/O
			$adresData['straat'], // Street address
			$adresData['postcode'], // Zip code
			$adresData['plaats'], // City
			$adresData['land'], // Country
			$adresData['huisnr'], // House number (AT/DE/NL only)
			$adresData['huisnr_toev'] // House extension (NL only)
		);
		$k->setAddress(KlarnaFlags::IS_BILLING, $addr);

		$adresData = $checkoutData['ship_address'];
		$addr = new KlarnaAddr(
			$adresData['email'], // Email address
			$adresData['telefoon'], // Telephone number, only one phone number is needed
			$adresData['mobiel'], // Cell phone number
			$adresData['voornaam'], // First name (given name)
			$adresData['achternaam'], // Last name (family name)
			'', // No care of, C/O
			$adresData['straat'], // Street address
			$adresData['postcode'], // Zip code
			$adresData['plaats'], // City
			$adresData['land'], // Country
			$adresData['huisnr'], // House number (AT/DE/NL only)
			$adresData['huisnr_toev'] // House extension (NL only)
		);
		$k->setAddress(KlarnaFlags::IS_SHIPPING, $addr);

		try {
			$result = $k->reserveAmount(
				$checkoutData['klantID'], // PNO (Date of birth for AT/DE/NL)
				null, // KlarnaFlags::MALE, KlarnaFlags::FEMALE (AT/DE/NL only)
				-1,   // Automatically calculate and reserve the cart total amount
				KlarnaFlags::NO_FLAG,
				KlarnaPClass::INVOICE
			);

//			$rno = $result[0];
//			$status = $result[1];
//			echo "OK: reservation {$rno} - order status {$status}\n";

			// $status is KlarnaFlags::PENDING or KlarnaFlags::ACCEPTED.

			return $result;
		} catch(Exception $e) {
			throw new BixKlarnaExeption($e->getMessage(),$e->getCode());
		}
	}

	/**
	 * catch return
	 * @return array
	 */
	public function doReturn () {
		$returnResult = array(
			'success' => false,
			'betaalID' => '',
			'betaalDatum' => '',
			'betaalStatus' => '',
			'message' => '',
			'redirect' => '',
			'response' => array()
		);
		$getData = JRequest::get('GET'); //howtodothatwiththeinputobject???
		$returnResult['request'] = $getData;
		$returnResult['debugEmail'] = "Bixie Klarna \n";

		$input = JFactory::getApplication()->input;
		$neededVars = array(
			'orderID' => 'string',
			'amount' => 'string',
			'currency' => 'string',
			'PM' => 'string',
			'ACCEPTANCE' => 'string',
			'STATUS' => 'string',
			'CARDNO' => 'string',
			'PAYID' => 'string',
			'NCERROR' => 'string',
			'BRAND' => 'string',
			'SHASIGN' => 'string'
		);
		$inputData = $input->getArray($neededVars);
		$inputComplete = true;
		foreach ($inputData as $key => $dataValue) {
			if ($dataValue === '') {
				$inputComplete = false;
				$returnResult['debugEmail'] .= "Missende parameter $key \n";
			}
		}
		if (!$inputComplete) {
			$returnResult['message'] = 'Returndata incompleet.';
		} else {
			$this->_validateTransaction($inputData, &$returnResult);
		}
//pr($returnResult);
		return $returnResult;
	}

	/**
	 * @param $inputData
	 * @param $returnResult
	 */
	protected function _validateTransaction ($inputData, &$returnResult) {
		//check sha
		$getData = JRequest::get('GET'); //howtodothatwiththeinputobject???
		foreach ($getData as $key => $value)
			if (strtoupper($key) != 'SHASIGN' && $value != '' && !in_array($key, self::$ignoreKeys))
				$ogoneParams[strtoupper($key)] = $value;

		ksort($ogoneParams);
		$shasign = '';
		foreach ($ogoneParams as $key => $value)
			$shasign .= strtoupper($key) . '=' . $value . $this->_SHA_OUT;
		$sha1 = strtoupper(sha1($shasign));

		if ($sha1 === $inputData['SHASIGN']) {
			$returnResult['success'] = true;
			$returnResult['betaalID'] = $inputData['PAYID'];
			$returnResult['betaalDatum'] = JFactory::getDate()->toSql();
			$returnResult['statusCode'] = $inputData['STATUS'];
			$returnResult['response'] = $inputData;

			switch ($inputData['STATUS']) {
				case 1:
					/* Real error or payment canceled */
					$returnResult['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_FAILURE_CANCEL');
					$statusName = 'BIX_CANCELLED';
					$returnResult['statusMessage'] = 'Real error or payment canceled';
					break;
				case 2:
					/* Real error - authorization refused */
					$returnResult['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_AUTH_FAILURE');
					$statusName = 'BIX_FAILURE';
					$returnResult['statusMessage'] = 'Real error - authorization refused';
					break;
				case 5:
				case 9:
					/* Payment OK */
					$statusName = 'BIX_SUCCESS';
					$returnResult['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_SUCCESS');
					$returnResult['statusMessage'] = 'Payment OK';
					break;
				case 6:
				case 7:
				case 8:
					// Payment canceled later
					$returnResult['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_CANCEL');
					$statusName = 'BIX_CANCELLED';
					$returnResult['statusMessage'] = 'Payment canceled later';
					break;
				default:
					$returnResult['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_UNKNOWN_STATUS');
					$statusName = 'BIX_FAILURE';
					$returnResult['statusMessage'] = 'Status unknown';
			}

			$returnResult['debugEmail'] .= "BetaalID: " . $returnResult['betaalID'] . " \n";
			$returnResult['betaalStatus'] = $statusName;
			$returnResult['debugEmail'] .= "Status: $statusName \n";

		} else {
			$returnResult['message'] = 'Ongeldige response! Sha-sleutel niet geldig.';
		}

	}

	/**
	 * @param $ogoneParams
	 * @return string
	 */
	protected function _buildForm ($ogoneParams) {
		$html = array();
		$html[] = '<form method="post" action="' . self::$actionUrl . '">';
		foreach ($ogoneParams as $key => $value) {
			$html[] = '<input type="hidden" name="' . $key . '" value="' . $value . '">';
		}
		$html[] = '<input type="submit" value="' . htmlspecialchars(JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_PAYMENT_BUTTON')) . '">';
		$html[] = '</form>';
		return implode($html);
	}

}

/**
 * Class BixKlarnaExeption
 */
class BixKlarnaExeption extends BixException {
}