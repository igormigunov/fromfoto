 <?

$m_curr = $_REQUEST['m_curr'];
$m_shop = S_SHOP;
$inv_id = $_REQUEST['inv_id'];
$out_summ = number_format(preg_replace("/\s/","",$_REQUEST['new_price']), 2, '.', '');

$inv_desc = $_REQUEST['inv_desc'];
$m_key = S_KEY;

 $mrh_login = "fromfoto"; 
 $mrh_pass1 = "7Qq9hoK9WU"; 
 $shp_item = 1; 
 $culture = $_REQUEST['land']; 
 $encoding = "utf-8";  
 
 $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"); 
 
 ?>
 
 
 <?
 print "<html><script language=JavaScript ". "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormV.js?". "MerchantLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id". "&Description=$inv_desc&SignatureValue=$crc&shpItem=$shp_item". "&Culture=$culture&Encoding=$encoding'></script></html>";

 ?>
 
 <style>
 	iframe{
		min-width:170px !important;
	}
 </style>