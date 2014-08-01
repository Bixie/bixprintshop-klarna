#exception dump request reserve amount 2014-01-08 ca 23.00uur lokaal
```
BixKlarnaExeption Object
(
    [message:protected] => Er is een integratiefout onstaan tussen de webwinkel en Klarna. Gelieve contact opnemen met de webwinkel voor meer info of kies een andere betalingswijze.
    [string:Exception:private] => 
    [code:protected] => 9113
    [file:protected] => /home/crmprescan/domains/bixieprintshop.nl/public_html/nlp/plugins/bixprintshop_betaal/bix_klarna/klarnahelper.php
    [line:protected] => 152
    [trace:Exception:private] => Array
        (
            [0] => Array
                (
                    [file] => /home/crmprescan/domains/bixieprintshop.nl/public_html/nlp/plugins/bixprintshop_betaal/bix_klarna/bix_klarna.php
                    [line] => 222
                    [function] => doSetup
                    [class] => BixKlarnahelper
                    [type] => ->
                    [args] => Array
                        (
                            [0] => Array
                                (
                                    [klantID] => 19780225
                                    [orders] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [quantity] => 100
                                                    [sku] => 31
                                                    [name] => Visitekaartjes
                                                    [price] => 21.21
                                                    [vat] => 21
                                                    [discount] => 0
                                                    [flags] => 32
                                                )

                                            [1] => Array
                                                (
                                                    [quantity] => 1
                                                    [sku] => klarna
                                                    [name] => Administratiekosten Klarna
                                                    [price] => 1.1132
                                                    [vat] => 21
                                                    [discount] => 0
                                                    [flags] => 48
                                                )

                                        )

                                    [bill_address] => Array
                                        (
                                            [email] => admin@bixie.nl
                                            [telefoon] => -
                                            [mobiel] => 0612345678
                                            [voornaam] => Testperson-nl
                                            [achternaam] => Approved
                                            [straat] => Neherkade
                                            [postcode] => 2521VA
                                            [plaats] => Gravenhage
                                            [land] => 154
                                            [huisnr] => 1
                                            [huisnr_toev] => XI
                                        )

                                    [ship_address] => Array
                                        (
                                            [email] => admin@bixie.nl
                                            [telefoon] => 
                                            [mobiel] => 
                                            [voornaam] => Matthijs
                                            [achternaam] => Alles
                                            [straat] => Borneostraat
                                            [postcode] => 7512AJ
                                            [plaats] => Enschede
                                            [land] => 154
                                            [huisnr] => 77
                                            [huisnr_toev] => 
                                        )

                                )

                        )

                )

            [1] => Array
                (
                    [function] => preparePayment
                    [class] => plgBixprintshopBix_klarna
                    [type] => ->
                    [args] => Array
                        (
                            [0] => BixCart Object
                                (
                                    [_cart:protected] => JRegistry Object
                                        (
                                            [data:protected] => stdClass Object
                                                (
                                                    [bestelID] => 11
                                                    [userID] => 141
                                                    [ordersNetto] => 17.53
                                                    [ordersBtw] => 3.6813
                                                    [totaalKorting] => 0
                                                    [kortingBtw] => 0
                                                    [administratiePrijs] => 0.92
                                                    [administratieBtw] => 0.1932
                                                    [totaalNetto] => 18.45
                                                    [totaalBtw] => 3.87
                                                    [totaalBruto] => 22.32
                                                    [orders] => Array
                                                        (
                                                            [31] => 31
                                                        )

                                                    [btw] => stdClass Object
                                                        (
                                                            [VN] => 0
                                                            [VL] => 0
                                                            [VH] => 18.45
                                                        )

                                                    [btwCalc] => stdClass Object
                                                        (
                                                            [btwCalc] => stdClass Object
                                                                (
                                                                    [bestelNetto] => 18.45
                                                                    [roundVN] => 0
                                                                    [roundVL] => 0
                                                                    [roundVH] => 18.45
                                                                    [btwVL] => 0
                                                                    [btwVH] => 3.87
                                                                    [bestelBtw] => 3.87
                                                                    [bestelBruto] => 22.32
                                                                )

                                                            [totalBtw] => stdClass Object
                                                                (
                                                                    [bestelNetto] => 18.45
                                                                    [roundVN] => 0
                                                                    [roundVL] => 0
                                                                    [roundVH] => 18.45
                                                                    [btwVL] => 0
                                                                    [btwVH] => 3.87
                                                                    [bestelBtw] => 3.87
                                                                    [bestelBruto] => 22.32
                                                                )

                                                            [couponBtw] => stdClass Object
                                                                (
                                                                    [VN] => 0
                                                                    [VL] => 0
                                                                    [VH] => 0
                                                                )

                                                            [adminBtw] => stdClass Object
                                                                (
                                                                    [VN] => 0
                                                                    [VL] => 0
                                                                    [VH] => 0.92
                                                                )

                                                        )

                                                    [nrOrders] => 1
                                                    [verzendAdresID] => 2
                                                    [factuurAdresID] => 5
                                                    [betaalMethode] => Bix_klarna
                                                    [betaalValidation] => Array
                                                        (
                                                            [allowed] => 1
                                                            [price] => 0.92
                                                            [btw] => 0.1932
                                                            [message] => Betaling via Klarna geselecteerd. Hiervoor wordt E 0,92 aan administratiekosten berekend.
                                                            [issuer] => 
                                                            [subForm] => 
                                                            [btwType] => VH
                                                            [betaalmethodeText] => Betaling via Klarna geselecteerd.
                                                        )

                                                    [vrwdnAccoord] => 1
                                                    [couponCode] => 
                                                    [bestelKortingInfo] => Array
                                                        (
                                                            [valid] => 
                                                            [couponusedID] => 0
                                                            [currentCartTotal] => 17.53
                                                            [title] => 
                                                            [message] => Code niet gevonden
                                                            [couponValue] => 0
                                                            [btwValue] => 0
                                                            [btw] => Array
                                                                (
                                                                    [VN] => 0
                                                                    [VL] => 0
                                                                    [VH] => 0
                                                                )

                                                        )

                                                    [activeStap] => 
                                                    [factuurNummer] => NLP-00012
                                                    [bestelComment] => 
                                                    [params] => Array
                                                        (
                                                            [factuurreferentie] => 
                                                        )

                                                )

                                        )

                                    [_orders:protected] => Array
                                        (
                                            [31] => BixOrder Object
                                                (
                                                    [orderID] => 31
                                                    [productNaam] => Visitekaartjes
                                                    [productID] => 5
                                                    [orderOptions] => Array
                                                        (
                                                        )

                                                    [orderoptionValues] => Array
                                                        (
                                                        )

                                                    [extraXmls] => Array
                                                        (
                                                        )

                                                    [attribClasses] => Array
                                                        (
                                                            [oplage] => AttribOplage Object
                                                                (
                                                                    [_optionValueClass:protected] => OptionvalueOplage
                                                                    [_eigenValue:protected] => 1
                                                                    [attribID] => 1
                                                                    [attribType] => oplage
                                                                    [attribName] => oplage
                                                                    [attribCalcOn] => plano
                                                                    [fieldName] => bpsattribs[oplage]
                                                                    [fieldID] => bpsattribsoplage
                                                                    [optionID] => 12
                                                                    [productID] => 5
                                                                    [orderID] => 31
                                                                    [orderoptionID] => 214
                                                                    [orderValue] => 100
                                                                    [orderoptionValues:protected] => Array
                                                                        (
                                                                            [100] => BixOrderoptionvalue Object
                                                                                (
                                                                                    [valueModel:protected] => 
                                                                                    [valueForms:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [_pk:protected] => orderoptionvalueID
                                                                                    [_error:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [orderoptionvalueID] => 211
                                                                                            [orderoptionID] => 214
                                                                                            [attribID] => 1
                                                                                            [valueLabel] => 100
                                                                                            [valueValue] => 100
                                                                                            [valueprices] => Array
                                                                                                (
                                                                                                )

                                                                                            [ordering] => 0
                                                                                            [valuedata] => Array
                                                                                                (
                                                                                                )

                                                                                            [params] => Array
                                                                                                (
                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [optionValues] => Array
                                                                        (
                                                                            [100] => stdClass Object
                                                                                (
                                                                                    [optionvalueID] => 54
                                                                                    [optionID] => 12
                                                                                    [attribID] => 1
                                                                                    [valueLabel] => 100
                                                                                    [valueValue] => 100
                                                                                    [valueprices] => Array
                                                                                        (
                                                                                        )

                                                                                    [valueType] => value
                                                                                    [ordering] => 0
                                                                                    [valuedata] => Array
                                                                                        (
                                                                                        )

                                                                                    [params] => Array
                                                                                        (
                                                                                        )

                                                                                    [attribType] => oplage
                                                                                )

                                                                            [250] => stdClass Object
                                                                                (
                                                                                    [optionvalueID] => 55
                                                                                    [optionID] => 12
                                                                                    [attribID] => 1
                                                                                    [valueLabel] => 250
                                                                                    [valueValue] => 250
                                                                                    [valueprices] => Array
                                                                                        (
                                                                                        )

                                                                                    [valueType] => value
                                                                                    [ordering] => 0
                                                                                    [valuedata] => Array
                                                                                        (
                                                                                        )

                                                                                    [params] => Array
                                                                                        (
                                                                                        )

                                                                                    [attribType] => oplage
                                                                                )

                                                                            [500] => stdClass Object
                                                                                (
                                                                                    [optionvalueID] => 56
                                                                                    [optionID] => 12
                                                                                    [attribID] => 1
                                                                                    [valueLabel] => 500
                                                                                    [valueValue] => 500
                                                                                    [valueprices] => Array
                                                                                        (
                                                                                        )

                                                                                    [valueType] => value
                                                                                    [ordering] => 0
                                                                                    [valuedata] => Array
                                                                                        (
                                                                                        )

                                                                                    [params] => Array
                                                                                        (
                                                                                        )

                                                                                    [attribType] => oplage
                                                                                )

                                                                            [1000] => stdClass Object
                                                                                (
                                                                                    [optionvalueID] => 57
                                                                                    [optionID] => 12
                                                                                    [attribID] => 1
                                                                                    [valueLabel] => 1000
                                                                                    [valueValue] => 1000
                                                                                    [valueprices] => Array
                                                                                        (
                                                                                        )

                                                                                    [valueType] => value
                                                                                    [ordering] => 0
                                                                                    [valuedata] => Array
                                                                                        (
                                                                                        )

                                                                                    [params] => Array
                                                                                        (
                                                                                        )

                                                                                    [attribType] => oplage
                                                                                )

                                                                            [2500] => stdClass Object
                                                                                (
                                                                                    [optionvalueID] => 58
                                                                                    [optionID] => 12
                                                                                    [attribID] => 1
                                                                                    [valueLabel] => 2500
                                                                                    [valueValue] => 2500
                                                                                    [valueprices] => Array
                                                                                        (
                                                                                        )

                                                                                    [valueType] => value
                                                                                    [ordering] => 0
                                                                                    [valuedata] => Array
                                                                                        (
                                                                                        )

                                                                                    [params] => Array
                                                                                        (
                                                                                        )

                                                                                    [attribType] => oplage
                                                                                )

                                                                        )

                                                                    [extraXmls] => Array
                                                                        (
                                                                        )

                                                                    [dependancies] => 
                                                                    [dependSources] => 
                                                                    [optionClasses] => Array
                                                                        (
                                                                            [0] => OptionvalueOplage Object
                                                                                (
                                                                                    [optionID] => 
                                                                                    [valueModel:protected] => 
                                                                                    [valueForms:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [_error:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [optionvalueID] => 54
                                                                                            [optionID] => 12
                                                                                            [attribID] => 1
                                                                                            [valueLabel] => 100
                                                                                            [valueValue] => 100
                                                                                            [valueprices] => Array
                                                                                                (
                                                                                                )

                                                                                            [valueType] => value
                                                                                            [ordering] => 0
                                                                                            [valuedata] => Array
                                                                                                (
                                                                                                )

                                                                                            [params] => Array
                                                                                                (
                                                                                                )

                                                                                            [attribType] => oplage
                                                                                        )

                                                                                )

                                                                            [1] => OptionvalueOplage Object
                                                                                (
                                                                                    [optionID] => 
                                                                                    [valueModel:protected] => 
                                                                                    [valueForms:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [_error:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [optionvalueID] => 55
                                                                                            [optionID] => 12
                                                                                            [attribID] => 1
                                                                                            [valueLabel] => 250
                                                                                            [valueValue] => 250
                                                                                            [valueprices] => Array
                                                                                                (
                                                                                                )

                                                                                            [valueType] => value
                                                                                            [ordering] => 0
                                                                                            [valuedata] => Array
                                                                                                (
                                                                                                )

                                                                                            [params] => Array
                                                                                                (
                                                                                                )

                                                                                            [attribType] => oplage
                                                                                        )

                                                                                )

                                                                            [2] => OptionvalueOplage Object
                                                                                (
                                                                                    [optionID] => 
                                                                                    [valueModel:protected] => 
                                                                                    [valueForms:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [_error:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [optionvalueID] => 56
                                                                                            [optionID] => 12
                                                                                            [attribID] => 1
                                                                                            [valueLabel] => 500
                                                                                            [valueValue] => 500
                                                                                            [valueprices] => Array
                                                                                                (
                                                                                                )

                                                                                            [valueType] => value
                                                                                            [ordering] => 0
                                                                                            [valuedata] => Array
                                                                                                (
                                                                                                )

                                                                                            [params] => Array
                                                                                                (
                                                                                                )

                                                                                            [attribType] => oplage
                                                                                        )

                                                                                )

                                                                            [3] => OptionvalueOplage Object
                                                                                (
                                                                                    [optionID] => 
                                                                                    [valueModel:protected] => 
                                                                                    [valueForms:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [_error:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [optionvalueID] => 57
                                                                                            [optionID] => 12
                                                                                            [attribID] => 1
                                                                                            [valueLabel] => 1000
                                                                                            [valueValue] => 1000
                                                                                            [valueprices] => Array
                                                                                                (
                                                                                                )

                                                                                            [valueType] => value
                                                                                            [ordering] => 0
                                                                                            [valuedata] => Array
                                                                                                (
                                                                                                )

                                                                                            [params] => Array
                                                                                                (
                                                                                                )

                                                                                            [attribType] => oplage
                                                                                        )

                                                                                )

                                                                            [4] => OptionvalueOplage Object
                                                                                (
                                                                                    [optionID] => 
                                                                                    [valueModel:protected] => 
                                                                                    [valueForms:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [_error:protected] => Array
                                                                                        (
                                                                                        )

                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [optionvalueID] => 58
                                                                                            [optionID] => 12
                                                                                            [attribID] => 1
                                                                                            [valueLabel] => 2500
                                                                                            [valueValue] => 2500
                                                                                            [valueprices] => Array
                                                                                                (
                                                                                                )

                                                                                            [valueType] => value
                                                                                            [ordering] => 0
                                                                                            [valuedata] => Array
                                                                                                (
                                                                                                )

                                                                                            [params] => Array
                                                                                                (
                                                                                                )

                                                                                            [attribType] => oplage
                                                                                        )

                                                                                )

                                                                        )

                                                                    [attribData:protected] => BixOrderoption Object
                                                                        (
                                                                            [orderoptionModel:protected] => 
                                                                            [orderoptionForm:protected] => 
                                                                            [_pk:protected] => orderoptionID
                                                                            [_error:protected] => Array
                                                                                (
                                                                                )

                                                                            [data:protected] => stdClass Object
                                                                                (
                                                                                    [orderoptionID] => 214
                                                                                    [orderID] => 31
                                                                                    [optionID] => 12
                                                                                    [attribID] => 1
                                                                                    [attribCalcOn] => plano
                                                                                    [attribName] => oplage
                                                                                    [attribLabel] => Oplage
                                                                                    [attribType] => oplage
                                                                                    [attribContent] => 
                                                                                    [attribParams] => stdClass Object
                                                                                        (
                                                                                            [holder_class] => 
                                                                                            [option_class] => uk-width-1-1
                                                                                            [show_description] => 0
                                                                                            [nr_cols] => 3
                                                                                            [hidden] => 1
                                                                                            [selectType] => select
                                                                                            [disabledStyle] => disabled
                                                                                            [multiple] => 0
                                                                                            [selectSize] => 1
                                                                                        )

                                                                                    [ordering] => 1
                                                                                    [financieel] => Array
                                                                                        (
                                                                                        )

                                                                                    [params] => stdClass Object
                                                                                        (
                                                                                            [holder_class] => 
                                                                                            [option_class] => uk-width-1-1
                                                                                            [show_description] => 0
                                                                                            [nr_cols] => 3
                                                                                            [hidden] => 1
                                                                                            [selectType] => select
                                                                                            [disabledStyle] => disabled
                                                                                            [multiple] => 0
                                                                                            [selectSize] => 1
                                                                                        )

                                                                                    [productID] => 5
                                                                                )

                                                                        )

                                                                    [_attribItem:protected] => JObject Object
                                                                        (
                                                                            [_errors:protected] => Array
                                                                                (
                                                                                )

                                                                            [attribID] => 1
                                                                            [attribName] => oplage
                                                                            [attribType] => oplage
                                                                            [attribContent] => 
                                                                            [attribLabel] => Oplage
                                                                            [attribDescr] => Geef het aantal te leveren stuk saan
                                                                            [attribValue] => 
                                                                            [attribCalcType] => 
                                                                            [attribCalcOn] => plano
                                                                            [attribCalcPer] => 
                                                                            [ordering] => 1
                                                                            [state] => 1
                                                                            [created] => 0000-00-00 00:00:00
                                                                            [created_by] => 0
                                                                            [modified] => 0000-00-00 00:00:00
                                                                            [modified_by] => 0
                                                                            [checked_out] => 0
                                                                            [checked_out_time] => 0000-00-00 00:00:00
                                                                            [params] => stdClass Object
                                                                                (
                                                                                    [holder_class] => 
                                                                                    [option_class] => uk-width-1-1
                                                                                    [show_description] => 0
                                                                                    [nr_cols] => 3
                                                                                    [hidden] => 1
                                                                                    [selectType] => select
                                                                                    [disabledStyle] => disabled
                                                                                    [multiple] => 0
                                                                                    [selectSize] => 1
                                                                                )

                                                                        )

                                                                    [_attribForm:protected] => BixForm Object
                                                                        (
                                                                            [data:protected] => JRegistry Object
                                                                                (
                                                                                    [data:protected] => stdClass Object
                                                                                        (
                                                                                            [attribID] => 
                                                                                            [attribName] => 
                                                                                            [attribType] => 
                                                                                            [attribContent] => 
                                                                                            [attribLabel] => 
                                                                                            [attribDescr] => 
                                                                                            [attribCalcOn] => 
                                                                                            [state] => 
                                                                                            [checked_out] => 
                                                                                            [checked_out_time] => 
                                                                                        )

                                                                                )

                                                                            [errors:protected] => Array
                                                                                (
                                                                                )

                                                                            [name:protected] => com_bixprintshop.attrib
                                                                            [options:protected] => Array
                                                                                (
                                                                                    [control] => jform
                                                                                )

                                                                            [xml:protected] => JXMLElement Object
                                                                                (
                                                                                    [fieldset] => Array
                                                                                        (
                                                                                            [0] => JXMLElement Object
                                                                                                (
                                                                                                    [@attributes] => Array
                                                                                                        (
                                                                                                            [name] => attrib
                                                                                                        )

                                                                                                    [field] => Array
                                                                                                        (
                                                                                                            [0] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribID
                                                                                                                            [type] => bixtext
                                                                                                                            [default] => 0
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ID
                                                                                                                            [readonly] => true
                                                                                                                            [class] => readonly
                                                                                                                            [description] => JGLOBAL_FIELD_ID_DESC
                                                                                                                        )

                                                                                                                )

                                                                                                            [1] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribName
                                                                                                                            [type] => bixedit
                                                                                                                            [size] => 40
                                                                                                                            [class] => inputbox
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBNAME
                                                                                                                            [description] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBNAME_DESC
                                                                                                                            [required] => true
                                                                                                                            [access] => config.admin
                                                                                                                            [filter] => safehtml
                                                                                                                        )

                                                                                                                )

                                                                                                            [2] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribLabel
                                                                                                                            [type] => bixtext
                                                                                                                            [size] => 40
                                                                                                                            [class] => inputbox inputTitle
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBLABEL
                                                                                                                            [description] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBLABEL_DESC
                                                                                                                            [required] => false
                                                                                                                            [filter] => safehtml
                                                                                                                        )

                                                                                                                )

                                                                                                            [3] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribDescr
                                                                                                                            [type] => textarea
                                                                                                                            [cols] => 40
                                                                                                                            [class] => inputbox
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBDESCR
                                                                                                                            [description] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBDESCR_DESC
                                                                                                                            [required] => false
                                                                                                                            [filter] => safehtml
                                                                                                                        )

                                                                                                                )

                                                                                                            [4] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribType
                                                                                                                            [type] => attribtypes
                                                                                                                            [size] => 1
                                                                                                                            [class] => inputbox
                                                                                                                            [alertclass] => box-warning small
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBTYPE
                                                                                                                            [description] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBTYPE_DESC
                                                                                                                            [message] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBTYPE_ALERT
                                                                                                                            [default] => 
                                                                                                                        )

                                                                                                                )

                                                                                                            [5] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribContent
                                                                                                                            [type] => hidden
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBCONTENT
                                                                                                                            [description] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBCONTENT_DESC
                                                                                                                            [default] => 
                                                                                                                        )

                                                                                                                )

                                                                                                            [6] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => attribCalcOn
                                                                                                                            [type] => bixlist
                                                                                                                            [size] => 1
                                                                                                                            [class] => inputbox
                                                                                                                            [label] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBCALCON
                                                                                                                            [description] => COM_BIXPRINTSHOP_ATTRIBS_ATTRIBCALCON_DESC
                                                                                                                            [default] => 
                                                                                                                        )

                                                                                                                    [option] => Array
                                                                                                                        (
                                                                                                                            [0] => ATTRIBCALCON_PLANO
                                                                                                                            [1] => ATTRIBCALCON_DESIGN
                                                                                                                            [2] => ATTRIBCALCON_AFWERKING
                                                                                                                            [3] => ATTRIBCALCON_BESTELLING
                                                                                                                            [4] => ATTRIBCALCON_CART
                                                                                                                        )

                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                            [1] => JXMLElement Object
                                                                                                (
                                                                                                    [@attributes] => Array
                                                                                                        (
                                                                                                            [name] => hiddenFields
                                                                                                        )

                                                                                                    [0] => 
	
                                                                                                )

                                                                                            [2] => JXMLElement Object
                                                                                                (
                                                                                                    [@attributes] => Array
                                                                                                        (
                                                                                                            [name] => settings
                                                                                                        )

                                                                                                    [field] => Array
                                                                                                        (
                                                                                                            [0] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => state
                                                                                                                            [type] => bixlist
                                                                                                                            [size] => 1
                                                                                                                            [class] => inputbox
                                                                                                                            [label] => JSTATUS
                                                                                                                            [description] => JFIELD_PUBLISHED_DESC
                                                                                                                            [default] => 1
                                                                                                                        )

                                                                                                                    [option] => Array
                                                                                                                        (
                                                                                                                            [0] => JPUBLISHED
                                                                                                                            [1] => JUNPUBLISHED
                                                                                                                        )

                                                                                                                )

                                                                                                            [1] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => checked_out
                                                                                                                            [type] => hidden
                                                                                                                            [filter] => unset
                                                                                                                        )

                                                                                                                )

                                                                                                            [2] => JXMLElement Object
                                                                                                                (
                                                                                                                    [@attributes] => Array
                                                                                                                        (
                                                                                                                            [name] => checked_out_time
                                                                                                                            [type] => hidden
                                                                                                                            [filter] => unset
                                                                                                                        )

                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [fields] => JXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [name] => params
                                                                                                )

                                                                                            [fieldset] => Array
                                                                                                (
                                                                                                    [0] => JXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [name] => paramskoppelingen
                                                                                                                )

                                                                                                            [field] => Array
                                                                                                                (
                                                                                                                    [0] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => spacerParamsTitle
                                                                                                                                    [type] => spacer
                                                                                                                                    [hr] => false
                                                                                                                                    [class] => title
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_TITLE_KOPPELINGEN
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_TITLE_KOPPELINGEN_DESC
                                                                                                                                )

                                                                                                                        )

                                                                                                                    [1] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => dependencies
                                                                                                                                    [type] => afhankelijkheden
                                                                                                                                    [size] => 50
                                                                                                                                    [class] => inputbox
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_DEPENDENCIES
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_DEPENDENCIES_DESC
                                                                                                                                    [required] => false
                                                                                                                                    [filter] => safehtml
                                                                                                                                    [default] => 
                                                                                                                                )

                                                                                                                        )

                                                                                                                )

                                                                                                            [comment] => JXMLElement Object
                                                                                                                (
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => JXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [name] => paramsprices
                                                                                                                )

                                                                                                            [0] => 
		
                                                                                                        )

                                                                                                    [2] => JXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [name] => paramslayout
                                                                                                                )

                                                                                                            [field] => Array
                                                                                                                (
                                                                                                                    [0] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => spacerParamsLayout
                                                                                                                                    [type] => spacer
                                                                                                                                    [hr] => false
                                                                                                                                    [class] => title
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_TITLE_LAYOUT
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_TITLE_LAYOUT_DESC
                                                                                                                                )

                                                                                                                        )

                                                                                                                    [1] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => holder_class
                                                                                                                                    [type] => text
                                                                                                                                    [size] => 30
                                                                                                                                    [class] => inputbox
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_HOLDERCLASS
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_HOLDERCLASS_DESC
                                                                                                                                    [required] => false
                                                                                                                                    [filter] => safehtml
                                                                                                                                )

                                                                                                                        )

                                                                                                                    [2] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => option_class
                                                                                                                                    [type] => text
                                                                                                                                    [size] => 30
                                                                                                                                    [class] => inputbox
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_OPTIONCLASS
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_OPTIONCLASS_DESC
                                                                                                                                    [required] => false
                                                                                                                                    [filter] => safehtml
                                                                                                                                )

                                                                                                                        )

                                                                                                                    [3] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => show_description
                                                                                                                                    [type] => bixradio
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_SHOW_DESCRIPTION
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_SHOW_DESCRIPTION_DESC
                                                                                                                                    [required] => false
                                                                                                                                    [filter] => safehtml
                                                                                                                                    [default] => 1
                                                                                                                                )

                                                                                                                            [option] => Array
                                                                                                                                (
                                                                                                                                    [0] => SHOW_DESCRIPTION_IN_TOOLTIP
                                                                                                                                    [1] => SHOW_DESCRIPTION_ONDER_HET_LABEL
                                                                                                                                    [2] => SHOW_DESCRIPTION_NIET
                                                                                                                                )

                                                                                                                        )

                                                                                                                    [4] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => nr_cols
                                                                                                                                    [type] => bixlist
                                                                                                                                    [class] => inputbox
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_NRCOLS
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_NRCOLS_DESC
                                                                                                                                    [default] => 3
                                                                                                                                )

                                                                                                                            [option] => Array
                                                                                                                                (
                                                                                                                                    [0] => 1
                                                                                                                                    [1] => 2
                                                                                                                                    [2] => 3
                                                                                                                                    [3] => -1
                                                                                                                                )

                                                                                                                        )

                                                                                                                    [5] => JXMLElement Object
                                                                                                                        (
                                                                                                                            [@attributes] => Array
                                                                                                                                (
                                                                                                                                    [name] => hidden
                                                                                                                                    [type] => bixradio
                                                                                                                                    [label] => COM_BIXPRINTSHOP_PARAMS_VERBORGEN
                                                                                                                                    [description] => COM_BIXPRINTSHOP_PARAMS_VERBORGEN_DESC
                                                                                                                                    [required] => false
                                                                                                                                    [default] => 0
                                                                                                                                )

                                                                                                                            [option] => Array
                                                                                                                                (
                                                                                                                                    [0] => BIX_NO
                                                                                                                                    [1] => BIX_YES
                                                                                                                                )

                                                                                                                        )

                     .........
 ```