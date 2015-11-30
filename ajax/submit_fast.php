<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<?
CModule::IncludeModule("iblock");
$m_curr = "RUB";
$m_shop = S_SHOP;
$inv_id = $_SESSION['PRODUCT_ID'];
$inv_desc = "Оплата заказа ".$_SESSION["PRODUCT_ID"];
$mrh_login = "fromfoto"; 
$mrh_pass1 = "7Qq9hoK9WU"; 
$shp_item = 7;
$culture = 'ru'; 
$encoding = "utf-8";
$def_sum = "100";
$crc  = md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=$shp_item"); 
?>
<form action='https://auth.robokassa.ru/Merchant/Index.aspx' method="POST" style="display: none;" id="PayForm">
	<input type="hidden" name="MrchLogin" value="<?=$mrh_login?>" />
	<input type="hidden" name="FreeOutSum" value="<?=$def_sum?>" id="DefaultSum" />
	<input type="hidden" name="InvoiceID" value="<?=$inv_id?>" />
	<input type="hidden" name="Description" value="<?=$inv_desc?>" />
	<input type="hidden" name="SignatureValue" value="<?=$crc?>" />
	<input type="hidden" name="shpItem" value="<?=$shp_item?>" />
	<input type="hidden" name="Culture" value="<?=$culture?>" />
	<input type="hidden" name="Encoding" value="<?=$encoding?>" />
	<input type="submit" value="Оплаить" style="display: none;" id="PauSubmit"/>
</form>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>