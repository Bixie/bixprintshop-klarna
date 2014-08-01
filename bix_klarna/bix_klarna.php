<?php
/**
 *    com_bix_printshop - Online-PrintStore for Joomla
 *  Copyright (C) 2011-2013 Matthijs Alles
 *    Bixie.org

 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once BIX_PATH_ADMIN_HELPERS . DS . 'betaalplugin.php';
require_once dirname(__FILE__) . DS . 'klarnahelper.php';
$className = 'plgBixprintshopBix_klarna';


/**
 * Class plgBixprintshopBix_klarna
 */
class plgBixprintshopBix_klarna extends BPSBetaalplugin {

	/**
	 * @var string
	 */
	public $pluginName = 'Bix_klarna';

	/**
	 * @var string
	 */
	public $debugEmail = '';

	/**
	 * @param object $subject
	 * @param array  $config
	 */
	public function __construct (&$subject, $config = array()) {
		parent::__construct($subject, $config);
		$this->baseDir = dirname(__FILE__);
		$this->webPath = str_replace(JPATH_ROOT . DS, '', $this->baseDir);
		JPlugin::loadLanguage('plg_bixprintshop_betaal_' . basename(__FILE__, ".php"));
	}

	/**
	 * @return JRegistry|string
	 */
	public function getInfo () {
		if (!BixTools::config('algemeen.betalen.bix_klarna.active')) return '';
		$info = new JRegistry();
		$info->set('naam', 'Bix_klarna');
		$info->set('title', JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_TITLE_CHECKOUT'));
		$info->set('desc', JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_DESC_CHECKOUT'));
		$info->set('image', $this->webPath . '/assets/logo_klarna.png');
		$info->set('config', BixTools::config('algemeen.betalen.bix_klarna'));
		return $info;
	}

	/**
	 * @param bixCart $bixCart
	 * @return string
	 */
	public function getValidation (bixCart $bixCart) {
		if (!BixTools::config('algemeen.betalen.bix_klarna.active') || $bixCart->get('betaalMethode') != 'Bix_klarna') return '';
		$betaalValidation = $bixCart->get('betaalValidation', array());
		if (!isset($betaalValidation['issuer'])) {
			$betaalValidation['issuer'] = '';
		}
//		if ($betaalValidation['allowed'] == false) {
//			return $this->pluginName;
//		}
		$betaalValidation['allowed'] = true;
		$betaalValidation['subForm'] = false;
		//subformvalues setten
		$checkoutPost = JRequest::getVar('checkout', array(), 'POST', 'array');
		if (isset($checkoutPost['betaalValidation'])) {
			$betaalValidation['issuer'] = isset($checkoutPost['betaalValidation']['issuer']) ? $checkoutPost['betaalValidation']['issuer'] : '';
		}
		$price = (float)BixTools::config('algemeen.betalen.bix_klarna.betaalPrijs', 0);
		$varPrice = (float)BixTools::config('algemeen.betalen.bix_klarna.betaalVarPrijs', 0);
		if ($varPrice > 0) {
			$price += round(($bixCart->get('totaalNetto') / 100) * $varPrice, 2);
		}
		$betaalValidation['price'] = $price;
		$betaalValidation['btw'] = BixTools::getBTWbedrag($betaalValidation['price'], $this->transactieBtw());
		$betaalValidation['btwType'] = $this->transactieBtw();
		$betaalValidation['betaalmethodeText'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_TEXT', true);
		if ($betaalValidation['issuer'] != '') {
			$betaalValidation['betaalmethodeText'] .= ' (' . JText::_('BIXBANK_' . $betaalValidation['issuer'], true) . ')';
		}
		$betaalValidation['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_SELECTED', true);
		if ($betaalValidation['price'] > 0) {
			$betaalValidation['message'] .= ' ' . JText::sprintf('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_KOSTEN_SPR', BixHtml::formatPrice($betaalValidation['price'], 'raw'), true);
		}
		//user
		$userGroups = JAccess::getGroupsByUser($bixCart->get('userID'), true);
		$allowedGroups = BixTools::config('algemeen.betalen.bix_klarna.allowedGroups', array());
		if (!count(array_intersect($userGroups, $allowedGroups))) {
			$betaalValidation['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_NIET_TOEGESTAAN', true);
			$betaalValidation['betaalmethodeText'] = JText::_('COM_BIXPRINTSHOP_BIX_KLARNA_REKENING_NIET_TOEGESTAAN', true);
			$betaalValidation['allowed'] = false;
		}
		//land
		$adresRow = BixTools::getItem('adres', $bixCart->get('factuurAdresID', 0));
		$adresObj = BixTools::getBixAdres($adresRow);
		if ($adresObj->get('land') != 'NL') {
			$betaalValidation['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_NIET_TOEGESTAAN_LAND', true);
			$betaalValidation['betaalmethodeText'] = JText::_('COM_BIXPRINTSHOP_BIX_KLARNA_REKENING_NIET_TOEGESTAAN_LAND', true);
			$betaalValidation['allowed'] = false;
		}
		if ($bixCart->get('totaalNetto') == 0) {
			$betaalValidation['message'] = JText::_('COM_BIXPRINTSHOP_PLUGIN_BETAAL_ORDER_NUL', true);
			$betaalValidation['allowed'] = false;
		}
		$bixCart->set('betaalValidation', $betaalValidation);

		return $this->pluginName;
	}

	/**
	 * @param bixCart $bixCart
	 * @return array|string
	 */
	public function preparePayment (bixCart $bixCart) {
		if (!BixTools::config('algemeen.betalen.bix_klarna.active') || stripos($bixCart->get('betaalMethode'), 'Bix_klarna') === false) return '';
		$betaalValidation = $bixCart->get('betaalValidation', array());
		$paymentInfo = new paymentInfo('prepare');
		$paymentInfo->amount = $bixCart->get('totaalBruto', 0);
		$paymentInfo->amount_open = $bixCart->get('totaalBruto', 0);
		$paymentInfo->factuurNummer = $bixCart->get('factuurNummer', '');
		$paymentInfo->betaalStatus = 'BIX_FAILURE';
		$paymentInfo->betaalDatum = JFactory::getDate()->toSql();

		//init vars
		$transaction_id = uniqid('klarna');
//		$uri = JURI::getInstance();
//		$prot = BixTools::config('algemeen.betalen.bix_klarna.useSecure', 1) ? 'https://' : 'http://';
//		$siteRoot = $prot . $uri->toString(array('host', 'port'));
//		$cartItemid = BixTools::config('algemeen.cartItemid', 0) ? '&Itemid=' . BixTools::config('algemeen.cartItemid', 0) : '';
//		$beschrijving = JText::sprintf('COM_BIXPRINTSHOP_CONFIG_BETALEN_BIX_KLARNA_TRANSACTION_DESC_SPR', $bixCart->get('factuurNummer', ''), $bixCart->get('bestelID', ''), JFactory::getApplication()->getCfg('sitename'));
//		$returnUrl = $siteRoot . '/index.php?option=com_bixprintshop&task=cart.betaalreturn';
//		$pushUrl = $siteRoot . '/index.php?option=com_bixprintshop&task=cart.betaalpush';
//		$failUrl = $siteRoot . '/' . JRoute::_('index.php?option=com_bixprintshop&view=cart' . $cartItemid);

//		'amount' => ($paymentInfo->amount * 100),
//			'terms_uri' => $siteRoot . '/index.php?Itemid=' . BixTools::config('algemeen.voorwaardenItemid', 101),
//			'checkout_uri' => $failUrl,
//			'confirmation_uri' => $returnUrl,
//			'push_uri' => $pushUrl,
//			'bestelID' => $bixCart->get('bestelID', 0),
		$checkoutData = array(
			'klantID' => '19780225',//$bixCart->frontUser->getValue('debiteurnummer', $bixCart->frontUser->id),
			'orders' => array(),
			'bill_address' => array(),
			'ship_address' => array()
		);
		$btwTarieven = BixTools::getBTW();
		foreach ($bixCart->get('orders') as $orderID) {
			$bixOrder = $bixCart->getBixOrder($orderID);

			$oplageAttrib = $bixOrder->attribClasses[$bixOrder->getAttribNameByType('oplage')];
			$oplageTotaal = $oplageAttrib->get('orderValue');

			$aOrderParams = (array)$bixOrder->get('params',array());
			$prodCode =  (!empty($aOrderParams['productCode'])) ? $aOrderParams['productCode']: $orderID;

			$checkoutData['orders'][] = array(
				'quantity'=>$oplageTotaal,          // Quantity
				'sku'=>$prodCode,             // Article number
				'name'=>$bixOrder->get('productNaam'),      // Article name/title
				'price'=>$bixOrder->get('orderBruto'),                 // Price
				'vat'=>($btwTarieven[$bixOrder->getBtwType()]*100),                     //  VAT
				'discount'=>0,                      // Discount todo
				'flags'=>KlarnaFlags::INC_VAT    // Price is including VAT.
			);

		}
		//administratiekosten
		$checkoutData['orders'][] = array(
			'quantity'=>1,          // Quantity
			'sku'=>'klarna',             // Article number
			'name'=>JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_ADMINKOSTEN_DESC'),      // Article name/title
			'price'=>($bixCart->get('administratiePrijs') + $bixCart->get('administratieBtw')),                 // Price
			'vat'=>($btwTarieven[$bixCart->getAdminBtwType()]*100),                     //  VAT
			'discount'=>0,                      // Discount
			'flags'=>KlarnaFlags::INC_VAT | KlarnaFlags::IS_HANDLING   // Price is including VAT.
		);
		//adressen
		$adresRow = BixTools::getItem('adres', $bixCart->get('factuurAdresID', 0));
		$adresObj = BixTools::getBixAdres($adresRow);
		$naamArr = $adresObj->seperateName();
		$checkoutData['bill_address'] = array(
			'email'=>$bixCart->frontUser->getValue('email', ''),
			'telefoon'=>$bixCart->frontUser->getValue('telefoon', '-'),
			'mobiel'=>$adresObj->get('telefoon'),
			'voornaam'=>$naamArr['voornaam'],
			'achternaam'=>$naamArr['achternaam'],
			'straat'=>$adresObj->get('straat'),
			'postcode'=>$adresObj->get('postcode'),
			'plaats'=>$adresObj->get('plaats'),
			'land'=>KlarnaCountry::NL,
			'huisnr'=>$adresObj->get('huisnummer'),
			'huisnr_toev'=>$adresObj->get('huisnummer_toevoeging')
		);
		$adresRow = BixTools::getItem('adres', $bixCart->get('verzendAdresID', 0));
		$adresObj = BixTools::getBixAdres($adresRow);
		$naamArr = $adresObj->seperateName();
		$checkoutData['ship_address'] = array(
			'email'=>$bixCart->frontUser->getValue('email', ''),
			'telefoon'=>$bixCart->frontUser->getValue('telefoon', ''),
			'mobiel'=>$adresObj->get('telefoon'),
			'voornaam'=>$naamArr['voornaam'],
			'achternaam'=>$naamArr['achternaam'],
			'straat'=>$adresObj->get('straat'),
			'postcode'=>$adresObj->get('postcode'),
			'plaats'=>$adresObj->get('plaats'),
			'land'=>KlarnaCountry::NL,
			'huisnr'=>$adresObj->get('huisnummer'),
			'huisnr_toev'=>$adresObj->get('huisnummer_toevoeging')
		);

		try {
			$bixKlarna = new BixKlarnahelper($transaction_id);
			$orderInfo = $bixKlarna->doSetup($checkoutData);
			pr($orderInfo);
			$formHtml = '';
			$paymentInfo->statusCode = 200;
			$paymentInfo->statusMessage = 'Klarna betaling voorbereid';
			$paymentInfo->success = true;
			$paymentInfo->valid = false;
			$paymentInfo->message = JText::_('COM_BIXPRINTSHOP_PLUGIN_BIX_KLARNA_PREPARED');

		} catch (BixKlarnaExeption $e) {
			$paymentInfo->statusCode = $e->getCode();
			$paymentInfo->statusMessage = 'Klarna betaling mislukt';
			$paymentInfo->success = false;
			$paymentInfo->valid = false;
			$paymentInfo->message = $e->getMessage();
pr($e);
			return array('pluginName' => $this->pluginName, 'paymentInfo' => $paymentInfo);
		}
		//echo $formHtml;
		$paymentInfo->betaalID = $transaction_id;
		$paymentInfo->betaalStatus = 'BIX_PENDING';
		if (!empty($gatewaySettings['GATEWAY_REDIRECT'])) {
			$paymentInfo->redirect = $formHtml;
			$paymentInfo->confirm = false;
		} else {
			$paymentInfo->redirect = 'form';
			$paymentInfo->formHtml = $formHtml;
		}

		$paymentInfo->bestelStatus = BixTools::config('algemeen.betalen.bix_klarna.status_' . strtolower($paymentInfo->betaalStatus));
		$paymentInfo->request = $checkoutData;
// pr($paymentInfo);
		$betaalValidation['paymentInfo'] = $paymentInfo;
		$bixCart->set('betaalValidation', $betaalValidation);
		return array('pluginName' => $this->pluginName, 'paymentInfo' => $paymentInfo);
	}

	/**
	 * @param BixCart   $bixCart
	 * @param BixBestel $bixBestel
	 * @return array|string
	 */
	public function returnPayment (BixCart $bixCart, BixBestel $bixBestel) {
		if (!BixTools::config('algemeen.betalen.bix_klarna.active') || stripos($bixBestel->get('betaalMethode'), 'Bix_klarna') === false) return '';
		$activePlugin = $bixBestel->get('betaalMethode');
		$cartItemid = BixTools::config('algemeen.cartItemid', 0) ? '&Itemid=' . BixTools::config('algemeen.cartItemid', 0) : '';
		$failUrl = JRoute::_('index.php?option=com_bixprintshop&view=cart' . $cartItemid);
		$afrondenItemid = BixTools::config('algemeen.afrondenItemid', 0) ? '&Itemid=' . BixTools::config('algemeen.afrondenItemid', 0) : '';
		$succesUrl = JRoute::_('index.php?option=com_bixprintshop&view=cart&layout=afronden' . $afrondenItemid);
		$transaction_id = JFactory::getApplication()->input->getString('orderID', '');
		$this->debugEmail = 'Betaalmethode: ' . $activePlugin . "\n\n";
//		$this->_postArray = JRequest::get('POST');
		$paymentInfo = new paymentInfo('return');
		$paymentInfo->factuurNummer = $bixCart->get('factuurNummer', '');
		$paymentInfo->amount = $bixCart->get('totaalBruto', 0);

		$bixKlarna = new BixKlarnahelper($transaction_id);
		$returnResult = $bixKlarna->doReturn();

		$paymentInfo->setGatewayResult($returnResult);
		$this->debugEmail .= $returnResult['debugEmail'];

		$paymentInfo->bestelStatus = BixTools::config('algemeen.betalen.bix_klarna.status_' . strtolower($paymentInfo->betaalStatus));
		$statusItem = BixTools::getItem('bestelstatus', $paymentInfo->bestelStatus);
// pr($statusItem);
		if ($statusItem->params['confirmed'] == 1) {
			$paymentInfo->returnUrl = $succesUrl;
			$paymentInfo->valid = true;
			$paymentInfo->amount_open = 0;
		} else {
			$paymentInfo->returnUrl = $failUrl;
			$paymentInfo->valid = false;
			$paymentInfo->amount_open = $bixCart->get('totaalBruto', 0);
		}
		$this->debugEmail .= "bestelStatus: " . $paymentInfo->bestelStatus . " \n";

		//pr($this->_postArray,$activePlugin);
		$this->debugEmail .= 'Request variabelen: ' . var_export($returnResult['request'], true) . "\n\n";
//echo nl2br($this->debugEmail).'debugEmail';
		if (BixTools::config('algemeen.betalen.bix_ideal.debug')) $this->mailDebug($this->debugEmail, JText::sprintf('BIX_PLUGIN_BIX_IDEAL_BETAALRETURN_SPR', $bixBestel->get('bestelID'), $paymentInfo->betaalID));
		return array('pluginName' => $activePlugin, 'return' => $paymentInfo);
	}

	/*statics*/
	/**
	 * @return array|string
	 */
	public static function getStatussen () {
		if (!BixTools::config('algemeen.betalen.bix_klarna.active')) return '';
		return parent::getStatussen();
	}
}

JDispatcher::getInstance()->register('', $className);
