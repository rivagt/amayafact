<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;

class XmlController extends Controller
{
    public function createXML()
    {
        header('Content-Type: text/html; charset=UTF-8');
        echo '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16pt; color: #000000; margin-bottom: 10px;">';
        echo 'Prueba Boleta electronica Amaya.<br>';
        echo '<span style="color: #000099; font-size: 15pt;">Crear archivo .XML correspondiente a la factura  electrónica.</span>';
        echo '<hr width="100%"></div>';
        $xml = new DOMDocument('1.0', "UTF-8");
        $xml->preserveWhiteSpace = false;

		$invoice = $xml->createElement('Invoice');
		$invoice = $xml->appendChild($invoice);
        //atributos invoice, se definen los prefijos de los demas
        $invoice->setAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
        $invoice->setAttribute('xmlns:cac', "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2");
        $invoice->setAttribute('xmlns:cbc', "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2");
        $invoice->setAttribute('xmlns:ccts', "urn:un:unece:uncefact:documentation:2");
        $invoice->setAttribute('xmlns:ds', "http://www.w3.org/2000/09/xmldsig#");
        $invoice->setAttribute('xmlns:ext', "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2");
        $invoice->setAttribute('xmlns:qdt', "urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2");
        $invoice->setAttribute('xmlns:udt', "urn:un:unece:uncefact:data:draft:UnqualifiedDataTypesSchemaModule:2");
        $invoice->setAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");
        //UBLExtensions
$UBLExtensions = $xml->createElement('ext:UBLExtensions');
$invoice->appendChild($UBLExtensions);

//UBLExtension
$UBLExtension = $xml->createElement('ext:UBLExtension');
$UBLExtensions->appendChild($UBLExtension);

//ExtensionContent
$ExtensionContent = $xml->createElement('ext:ExtensionContent');
$UBLExtension->appendChild($ExtensionContent);

//Firma digital
$Signature = $xml->createElement('ds:Signature');
$ExtensionContent->appendChild($Signature);
$Signature->setAttribute('Id','CompletarIDSIgnature');

$signedinfo = $xml->createElement('ds:SignedInfo');
$Signature->appendChild($signedinfo);

$canonicalizationmethod = $xml->createElement('ds:CanonicalizationMethod');
$signedinfo->appendChild($canonicalizationmethod);
$canonicalizationmethod->setAttribute('Algorithm','http://www.w3.org/TR/2001/REC-xml-c14n-20010315');

$signaturemethod = $xml->createElement('ds:SignatureMethod');
$signedinfo->appendChild($signaturemethod);
$signaturemethod->setAttribute('Algorithm','http://www.w3.org/2000/09/xmldsig#dsa-sha1');

$reference = $xml->createElement('ds:Reference');
$signedinfo->appendChild($reference);
$reference->setAttribute('URI','');

$transforms = $xml->createElement('ds:Transforms');
$reference->appendChild($transforms);

$transform = $xml->createElement('ds:Transform');
$transforms->appendChild($transform);
$transform->setAttribute('Algorithm','http://www.w3.org/2000/09/xmldsig#enveloped-signature');

$digestmethod = $xml->createElement('ds:DigestMethod');
$reference->appendChild($digestmethod);
$digestmethod->setAttribute('Algorithm','http://www.w3.org/2000/09/xmldsig#sha1');

$digestvalue = $xml->createElement('ds:DigestValue','Valor de DigestValue');
$reference->appendChild($digestvalue);

$signaturevalue = $xml->createElement('ds:SignatureValue','Valor de signature');
$Signature->appendChild($signaturevalue);

$keyinfo = $xml->createElement('ds:KeyInfo');
$Signature->appendChild($keyinfo);

$x509data = $xml->createElement('ds:X509Data');
$keyinfo->appendChild($x509data);

$x509Certificate = $xml->createElement('ds:X509Certificate','valor de certificado');
$x509data->appendChild($x509Certificate);

//UBLVERSION de ubl
$UBLVersion = $xml->createElement('cbc:UBLVersionID','2.1');
$invoice->appendChild($UBLVersion);

//Version documento
$customizationid = $xml->createElement('cbc:CustomizationID','2.0');
$invoice->appendChild($customizationid);

//Tipo de operacion
$profileid = $xml->createElement('cbc:ProfileID','0101');
$invoice->appendChild($profileid);
$profileid->setAttribute('schemeName','SUNAT:Identificador de Tipo de Operación');
$profileid->setAttribute('schemeAgencyName','PE:SUNAT');
$profileid->setAttribute('schemeURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo17');

//Codigo y serie de boleta
$idboleta = $xml->createElement('cbc:ID','SerieBoleta');
$invoice->appendChild($idboleta);

//Fecha y hora de emision
$fechaemision = $xml->createElement('cbc:IssueDate','fecha de emision');
$invoice->appendChild($fechaemision);
$horaemision = $xml->createElement('cbc:IssueTime','horaemision');
$invoice->appendChild($horaemision);

//Codigo para tipo de documento
$tipodocumento = $xml->createElement('cbc:InvoiceTypeCode','03');
$invoice->appendChild($tipodocumento);
$tipodocumento->setAttribute('listAgencyName','PE:SUNAT');
$tipodocumento->setAttribute('listName','SUNAT:Identificador de Tipo de Documento');
$tipodocumento->setAttribute('listURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01');

//Leyendas(Monto expresado en letras y observaciones)
$leyendamonto = $xml->createElement('cbc:Note','Monto expresado en letras');
$invoice->appendChild($leyendamonto);
$leyendamonto->setAttribute('languageLocaleID','1000');

$observacion = $xml->createElement('cbc:Note','Observaciones');
$invoice->appendChild($observacion);
$observacion->setAttribute('languageLocaleID','2001');
//Bienes transferidos en la Amazonía
//Servicios prestados en la Amazonía

//por regularizar clave primaria de software
$keysoftware = $xml->createElement('cbc:Note','codigo generada por el software');
$invoice->appendChild($keysoftware);
$keysoftware->setAttribute('languageLocaleID','3000');

//Tipo de moneda
$monedatype = $xml->createElement('cbc:DocumentCurrencyCode','PEN');
$invoice->appendChild($monedatype);
$monedatype->setAttribute('listID','ISO 4217 Alpha');
$monedatype->setAttribute('listName','Currency');
$monedatype->setAttribute('listAgencyName','United Nations Economic Commission for Europe');

//Signature exgt cac
$cacsignature = $xml->createElement('cac:Signature');
$invoice->appendChild($cacsignature);


$cbcid = $xml->createElement('cbc:ID','IdSignKG');
$cacsignature->appendChild($cbcid);

$signatoryparty = $xml->createElement('cac:SignatoryParty');
$cacsignature->appendChild($signatoryparty);

$partyidentification = $xml->createElement('cac:PartyIdentification');
$signatoryparty->appendChild($partyidentification);

$partyid = $xml->createElement('cbc:ID','20604665567');
$partyidentification->appendChild($partyid);

$partyname = $xml->createElement('cac:PartyName');
$signatoryparty->appendChild($partyname);
//&amp;
$cbcpartyname = $xml->createElement('cbc:Name');
$partyname->appendChild($cbcpartyname);
$cbcpartyname->appendChild($xml->createCDATASection("J & L AMAYA CORPORATION SOCIEDAD ANONIMA CERRADA - J & L  AMAYA CORPORATION S.A.C."));

$digitalsignatureatt = $xml->createElement('cac:DigitalSignatureAttachment');
$cacsignature->appendChild($digitalsignatureatt);

$cacexternalref = $xml->createElement('cac:ExternalReference');
$digitalsignatureatt->appendChild($cacexternalref);

$cbcuri =$xml->createElement('cbc:URI','#signatureKG');
$cacexternalref->appendChild($cbcuri);

//Nombre comercial de emisor
$accoutingsupplierparty = $xml->createElement('cac:AccoutingSupplierParty');
$invoice->appendChild($accoutingsupplierparty);

$cacparty = $xml->createElement('cac:Party');
$accoutingsupplierparty->appendChild($cacparty);

$cacpartyname = $xml->createElement('cac:PartyName');
$cacparty->appendChild($cacpartyname);

$cbcname = $xml->createElement('cbc:Name');
$cacpartyname->appendChild($cbcname);
// $cbcname->appendChild($xml->createCDATASection("J & L AMAYA CORPORATION SOCIEDAD ANONIMA CERRADA - J & L  AMAYA CORPORATION S.A.C."));

//nombre de emisor
$cacpartytaxscheme = $xml->createElement('cac:PartyTaxScheme');
$cacparty->appendChild($cacpartytaxscheme);

$cbcregistrationname = $xml->createElement('cbc:RegistrationName');
$cacpartytaxscheme->appendChild($cbcregistrationname);
$cbcregistrationname->appendChild($xml->createCDATASection("J & L AMAYA CORPORATION SOCIEDAD ANONIMA CERRADA - J & L  AMAYA CORPORATION S.A.C."));

//ruc emisor
$cbccompanyid = $xml->createElement('cbc:CompanyID','20604665567');
$cacpartytaxscheme->appendChild($cbccompanyid);
$cbccompanyid->setAttribute('schemeID','6');
$cbccompanyid->setAttribute('schemeName','SUNAT:Identificador de Documento de Identidad');
$cbccompanyid->setAttribute('schemeAgencyName','PE:SUNAT');
$cbccompanyid->setAttribute('schemeURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06');

//direccion emisor
$registrationaddress = $xml->createElement('cac:RegistrationAddress');
$cacpartytaxscheme->appendChild($registrationaddress);

$addresstypecode = $xml->createElement('cbc:AddressTypeCode','0');
$registrationaddress->appendChild($addresstypecode);
$addresstypecode->setAttribute('listAgencyName','PE:SUNAT');
$addresstypecode->setAttribute('lisName','Establecimiento Anexos');

$cbcbuildingnumber = $xml->createElement('cbc:BuildingNumber');
$registrationaddress->appendChild($cbcbuildingnumber);

$citysubdivisionname = $xml->createElement('cbc:CitySubdivisionName','-');
$registrationaddress->appendChild($citysubdivisionname);

$cityname =$xml->createElement('cbc:CityName');
$registrationaddress->appendChild($cityname);
$cityname->appendChild($xml->createCDATASection("CHANCHAMAYO"));

$countrysubentity = $xml->createElement('cbc:CountrySubentity');
$registrationaddress->appendChild($countrysubentity);
$countrysubentity->appendChild($xml->createCDATASection('JUNIN'));

$countrysubentitycode = $xml->createElement('cbc:CountrySubentityCode');
$registrationaddress->appendChild($countrysubentitycode);
$countrysubentitycode->appendChild($xml->createCDATASection('120302'));

$district = $xml->createElement('cbc:District');
$registrationaddress->appendChild($district);
$district->appendChild($xml->createCDATASection('PERENE'));

$cacaddressline = $xml->createElement('cac:AddressLine');
$registrationaddress->appendChild($cacaddressline);

$cbcline = $xml->createElement('cbc:Line');
$cacaddressline->appendChild($cbcline);
$cbcline->appendChild($xml->createCDATASection('AV. MARGINAL S/N URB. SANTA ANA S72289503 80 MTS PUENTE JUAN VELASCO'));

//datos de adquiriente
$accoutingcustomerparty = $xml->createElement('cac:AccountingCustomerParty');
$invoice->appendChild($accoutingcustomerparty);

$customerparty = $xml->createElement('cac:Party');
$accoutingcustomerparty->appendChild($customerparty);

$customerpartytaxscheme = $xml->createElement('cac:PartyTaxScheme');
$customerparty->appendChild($customerpartytaxscheme);

$customername = $xml->createElement('cbc:RegistrationName');
$customerpartytaxscheme->appendChild($customername);
$customername->appendChild($xml->createCDATASection('Nombre de adquiriente'));

$customercompanyid = $xml->createElement('cbc:CompanyID','Documento de adquiriente');
$customerpartytaxscheme->appendChild($customercompanyid);
$customercompanyid->setAttribute('schemeID','1');
$customercompanyid->setAttribute('schemeName','SUNAT:Identificador de Documento de Identidad');
$customercompanyid->setAttribute('schemeAgencyName','PE:SUNAT');
$customercompanyid->setAttribute('schemeURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06');

//apartado de tributos- operaciones exoneradas
$taxtotal = $xml->createElement('cac:TaxTotal');
$invoice->appendChild($taxtotal);

$taxamount = $xml->createElement('cbc:TaxAmount','0.00');
$taxtotal->appendChild($taxamount);
$taxamount->setAttribute('currencyID','PEN');

$taxsubtotal = $xml->createElement('cac:TaxSubtotal');
$taxtotal->appendChild($taxsubtotal);

$taxableamount = $xml->createElement('cbc:TaxableAmount','Monto total boleta');
$taxsubtotal->appendChild($taxableamount);
$taxableamount->setAttribute('currencyID','PEN');

$subtaxamount = $xml->createElement('cbc:TaxAmount','0.00');
$taxsubtotal->appendChild($subtaxamount);
$subtaxamount->setAttribute('currencyID','PEN');

$taxcategory = $xml->createElement('cac:TaxCategory');
$taxsubtotal->appendChild($taxcategory);

$taxcategoryid = $xml->createElement('cbc:ID','E');
$taxcategory->appendChild($taxcategoryid);
$taxcategoryid->setAttribute('schemeID','UN/ECE 5305');
$taxcategoryid->setAttribute('schemeName','Tax Category Identifier');
$taxcategoryid->setAttribute('schemeAgencyName','United Nations Economic Commission for Europe');

$taxscheme = $xml->createElement('cac:TaxScheme');
$taxcategory->appendChild($taxscheme);

$taxschemeid = $xml->createElement('cbc:ID','9997');
$taxscheme->appendChild($taxschemeid);
$taxschemeid->setAttribute('schemeAgencyName','PE:SUNAT');
$taxschemeid->setAttribute('schemeID','UN/ECE 5305');
$taxschemeid->setAttribute('schemeName','Codigo de tributos');

$taxschemename = $xml->createElement('cbc:Name','EXO');
$taxscheme->appendChild($taxschemename);

$taxtypecode = $xml->createElement('cbc:TaxTypeCode','VAT');
$taxscheme->appendChild($taxtypecode);

//totalvalorventa
$caclegalmonetarytotal = $xml->createElement('cac:LegalyMonetaryTotal');
$invoice->appendChild($caclegalmonetarytotal);

$cbclineextensionamount = $xml->createElement('cbc:LineExtensionAmount','Total venta');
$caclegalmonetarytotal->appendChild($cbclineextensionamount);
$cbclineextensionamount->setAttribute('currencyID','PEN');

$allowancetotalamount = $xml->createElement('cbc:AllowanceTotalAmount','0.00');
$caclegalmonetarytotal->appendChild($allowancetotalamount);
$allowancetotalamount->setAttribute('currencyID','PEN');

$chargetotalamount = $xml->createElement('cbc:ChargeTotalAmount','0.00');
$caclegalmonetarytotal->appendChild($chargetotalamount);
$chargetotalamount->setAttribute('currencyID','PEN');

//anticipos
$prepaidamount = $xml->createElement('cbc:PrepaidAmount','0.00');
$caclegalmonetarytotal->appendChild($prepaidamount);
$prepaidamount->setAttribute('currencyID','PEN');

$payableamount = $xml->createElement('cbc:PayableAmount','total venta');
$caclegalmonetarytotal->appendChild($payableamount);
$payableamount->setAttribute('currencyID','PEN');

//each para cada item vendido
$valor = [];
$i=0;
// foreach ($valor as $dato){
    $i++;
    $numerolinea = $i;
    $invoiceline = $xml->createElement('cac:InvoiceLine');
    $invoice->appendChild($invoiceline);

    $cbcidline = $xml->createElement('cbc:ID',$numerolinea);
    $invoiceline->appendChild($cbcidline);

    $invoicequantity = $xml->createElement('cbc:InvoiceQuantity','cantidad de item');
    $invoiceline->appendChild($invoicequantity);
    $invoicequantity->setAttribute('unitCode','Unidad de medida segun codigo');
    $invoicequantity->setAttribute('unitCodeListID','UN/ECE rec 20');
    $invoicequantity->setAttribute('unitCodeListAgencyName','United Nations Economic Commission for Europe');

    $lineextensionitem = $xml->createElement('cbc:LineExtensionAmount','Cantidad * precio unitario');
    $invoiceline->appendChild($lineextensionitem);
    $lineextensionitem->setAttribute('currencyID','PEN');

    $pricingref = $xml->createElement('cac:PricingReference');
    $invoiceline->appendChild($pricingref);

    $alternativeconditionprice = $xml->createElement('cac:AlternativeConditionPrice');
    $pricingref->appendChild($alternativeconditionprice);

    $priceamountitem = $xml->createElement('cbc:PriceAmount','precio unitario');
    $alternativeconditionprice->appendChild($priceamountitem);
    $priceamountitem->setAttribute('currencyID','PEN');

    $pricetypecode = $xml->createElement('cbc:PriceTypeCode','01');
    $alternativeconditionprice->appendChild($pricetypecode);
    $pricetypecode->setAttribute('listName','SUNAT:Indicador de Tipo de Precio');
    $pricetypecode->setAttribute('listAgencyName','PE:SUNAT');
    $pricetypecode->setAttribute('listURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16');

    $allowancechargeitem = $xml->createElement('cac:AllowanceCharge');
    $invoiceline->appendChild($allowancechargeitem);

    $cbcchargeindicator = $xml->createElement('cbc:ChargeIndicator','true');
    $allowancechargeitem->appendChild($cbcchargeindicator);

    $cbcamountitem = $xml->createElement('cbc:Amount','0.00');
    $allowancechargeitem->appendChild($cbcamountitem);
    $cbcamountitem->setAttribute('currencyID','PEN');

    //afectacion impuestos por item
    $taxtotalitem = $xml->createElement('cac:TaxTotal');
    $invoiceline->appendChild($taxtotalitem);

    $taxamountitem = $xml->createElement('cbc:TaxAmount','0.00');
    $taxtotalitem->appendChild($taxamountitem);
    $taxamountitem->setAttribute('currencyID','PEN');

    $taxsubtotalitem = $xml->createElement('cac:TaxSubtotal');
    $taxtotalitem->appendChild($taxsubtotalitem);

    $taxableamountitem = $xml->createElement('cbc:TaxableAmount','Cantidad*precio unit');
    $taxsubtotalitem->appendChild($taxableamountitem);
    $taxableamountitem->setAttribute('currencyID','PEN');

    $taxamountitem2 = $xml->createElement('cbc:TaxAmount','0.00');
    $taxsubtotalitem->appendChild($taxamountitem2);
    $taxamountitem2->setAttribute('currencyID','PEN');

    $taxcategoryitem = $xml->createElement('cac:TaxCategory');
    $taxsubtotalitem->appendChild($taxcategoryitem);

    $taxcategoryitemid = $xml->createElement('cbc:ID','S');
    $taxcategoryitem->appendChild($taxcategoryitemid);
    $taxcategoryitemid->setAttribute('schemeAgencyName','United Nations Economic Commission for Europe');
    $taxcategoryitemid->setAttribute('schemeID','UN/ECE 5305');
    $taxcategoryitemid->setAttribute('schemeName','Tax Category Identifier');

    $percent = $xml->createElement('cbc:Percent','0.00');
    $taxcategoryitem->appendChild($percent);

    $tierrange = $xml->createElement('cbc:TierRange','0');
    $taxcategoryitem->appendChild($tierrange);

    $taxschemeitem = $xml->createElement('cac:TaxScheme');
    $taxcategoryitem->appendChild($taxschemeitem);

    $taxschemeitemid = $xml->createElement('cbc:ID','2000');
    $taxschemeitem->appendChild($taxschemeitemid);
    $taxschemeitemid->setAttribute('schemeAgencyName','PE:SUNAT');
    $taxschemeitemid->setAttribute('schemeID','UN/ECE 5153');
    $taxschemeitemid->setAttribute('schemeName','Codigo de Tributos');

    $taxschemeitemname = $xml->createElement('cbc:Name','ISC');
    $taxschemeitem->appendChild($taxschemeitemname);

    $taxtypecodeitem = $xml->createElement('cbc:TaxTypeCode','EXC');
    $taxschemeitem->appendChild($taxtypecodeitem);

    //Otros impuestos
    $taxsubtotalitem2 = $xml->createElement('cac:TaxSubtotal');
    $taxtotalitem->appendChild($taxsubtotalitem2);

    $taxableamountitem2 = $xml->createElement('cbc:TaxableAmount','Cantidad*precio unit');
    $taxsubtotalitem2->appendChild($taxableamountitem2);
    $taxableamountitem2->setAttribute('currencyID','PEN');

    $taxamountitem3 = $xml->createElement('cbc:TaxAmount','0.00');
    $taxsubtotalitem2->appendChild($taxamountitem3);
    $taxamountitem3->setAttribute('currencyID','PEN');

    $taxcategoryitem2 = $xml->createElement('cac:TaxCategory');
    $taxsubtotalitem2->appendChild($taxcategoryitem2);

    $taxcategoryitemid2 = $xml->createElement('cbc:ID','E');
    $taxcategoryitem2->appendChild($taxcategoryitemid2);
    $taxcategoryitemid2->setAttribute('schemeAgencyName','United Nations Economic Commission for Europe');
    $taxcategoryitemid2->setAttribute('schemeID','UN/ECE 5305');
    $taxcategoryitemid2->setAttribute('schemeName','Tax Category Identifier');

    $percent2 = $xml->createElement('cbc:Percent','0.00');
    $taxcategoryitem2->appendChild($percent2);

    $taxexmptionreasoncode = $xml->createElement('cbc:TaxExemptionReasonCode','20');
    $taxcategoryitem2->appendChild($taxexmptionreasoncode);
    $taxexmptionreasoncode->setAttribute('listAgencyName','PE:SUNAT');
    $taxexmptionreasoncode->setAttribute('listName','Afectacion del IGV');
    $taxexmptionreasoncode->setAttribute('listURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07');

    $taxschemeitem2 = $xml->createElement('cac:TaxScheme');
    $taxcategoryitem2->appendChild($taxschemeitem2);

    $taxschemeitemid2 = $xml->createElement('cbc:ID','9997');
    $taxschemeitem2->appendChild($taxschemeitemid2);
    $taxschemeitemid2->setAttribute('schemeAgencyName','PE:SUNAT');
    $taxschemeitemid2->setAttribute('schemeID','UN/ECE 5153');
    $taxschemeitemid2->setAttribute('schemeName','Codigo de Tributos');

    $taxschemeitemname2 = $xml->createElement('cbc:Name','EXO');
    $taxschemeitem2->appendChild($taxschemeitemname2);

    $taxtypecodeitem2 = $xml->createElement('cbc:TaxTypeCode','VAT');
    $taxschemeitem2->appendChild($taxtypecodeitem2);

    //descripcion del item
    $item = $xml->createElement('cac:Item');
    $invoiceline->appendChild($item);

    $description = $xml->createElement('cbc:Description');
    $item->appendChild($description);
    $description->appendChild($xml->createCDATASection('Descripcion de producto'));

    $sellersitemid = $xml->createElement('cac:SellersItemIdentification');
    $item->appendChild($sellersitemid);

    $sellersid = $xml->createElement('cbc:ID');
    $sellersitemid->appendChild($sellersid);

    //precio unitario de item
    $price = $xml->createElement('cac:Price');
    $invoiceline->appendChild($price);

    $pricevalue = $xml->createElement('cbc:PriceAmount','precio unitario');
    $price->appendChild($pricevalue);
    $pricevalue->setAttribute('currencyID','PEN');
// }
//numero de linea




//Guardado de xml
$xml->formatOutput = true;
$strings_xml = $xml->saveXML();

$xml->save('../public/boletaprueba.xml');
chmod('../public/boletaprueba.xml', 0777);
$status = 'Buscar en :';
return $status;
        // $request = 1;
        // if($request==1){
        //     return "Successfully";
        // }
        // else{
        //     return "Error creando XML";
        // }

    }
}
