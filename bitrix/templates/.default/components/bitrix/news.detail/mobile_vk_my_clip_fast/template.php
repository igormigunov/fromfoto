<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arFilter = Array(
   "IBLOCK_TYPE"=>"clips", 
   "ACTIVE"=>"Y", 
   "ID"=>$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","PROPERTY_COST","PROPERTY_CURRENCY","PROPERTY_FREE_PERIOD", "PROPERTY_SHOW_OPROS", "PROPERTY_VIDEO_COST", "PROPERTY_FREE_PRICE"));
$ar_clip = $res->GetNext();
function Get_currency($currency){
	switch ($currency) {
	    case "3":
	        return "р.";
	        break;
	    case "4":
	        return "$";
	        break;
	    case "17":
	        return "EUR";
	        break;
	}	
}

function Get_currency_robo($currency){
	switch ($currency) {
	    case "3":
	        return "";
	        break;
	    case "4":
	        return "WMZ";
	        break;
	    case "17":
	        return "WME";
	        break;
	}	
}


//настройки для логотипа.
$arFilter = Array(
   "IBLOCK_ID"=>"17", 
   "ACTIVE"=>"Y", 
   "ID"=>"1586"
   );
$arSelect = array("NAME","PREVIEW_TEXT","ID","PROPERTY_LOGO_COST","PROPERTY_LOGO_SIZE");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$logo_sett = $res->GetNext();

if(empty($arResult['PROPERTIES']['PAID']['VALUE']))
{
	$path = CFile::GetPath($arResult["PROPERTIES"]["VIDEO"]["VALUE"]);	
} else {
	$path = (!empty($arResult['PROPERTIES']['YOUTUBE']['VALUE']))?$arResult['PROPERTIES']['YOUTUBE']['VALUE']:$arResult['PROPERTIES']['FILE_LINK']['VALUE'];	
};

?>

<div class="klip-text" style="width: 95%;">
<?
	$no_logo_cost = ($arResult['PROPERTIES']['NO_LOGO']['VALUE'])?$logo_sett['PROPERTY_LOGO_COST_VALUE']:0;
	$ar_clip['PROPERTY_COST_VALUE'] = ($arResult['PROPERTIES']['NO_LOGO']['VALUE'])?($ar_clip['PROPERTY_COST_VALUE'] + $logo_sett['PROPERTY_LOGO_COST_VALUE']):$ar_clip['PROPERTY_COST_VALUE'];
	$cost_video = ($ar_clip['PROPERTY_VIDEO_COST_VALUE'] || $ar_clip['PROPERTY_VIDEO_COST_VALUE'] === '0')? trim($ar_clip['PROPERTY_VIDEO_COST_VALUE']): "100";
	if($arResult['PROPERTIES']['VIDEO_COUNT']['VALUE']){
		$ar_clip['PROPERTY_COST_VALUE'] += $arResult['PROPERTIES']['VIDEO_COUNT']['VALUE']*$cost_video;
	}
	if($ar_clip['PROPERTY_FREE_PRICE_VALUE']){
		$ar_clip['PROPERTY_COST_VALUE'] = 777;
	}
	$ar_clip['PROPERTY_COST_VALUE'] = GetMessage("S_MIN_PRICE");
?>    
	<div class="video_descr">
    <? if(!$arResult['PROPERTIES']['PAID']['VALUE']): ?>
    	<?
        	$_plural_days = array(GetMessage("S_DAY"), GetMessage("S_DAYS"), GetMessage("S_DAYS1")); 
			$day = round((strtotime($arResult["ACTIVE_TO"])-time())/(3600*24));
			if($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 27 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 3){
				$m_curr = "RUB";
			}elseif($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 4 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 8){
				$m_curr = "USD";
			}else{
			$m_curr = "EUR";
			}
			$m_shop = S_SHOP;
			$inv_id = $arResult['ID']*1000;
			$out_summ = number_format(preg_replace("/\s/","",$ar_clip['PROPERTY_COST_VALUE']), 2, '.', '');
		?>
<p class="text-done"><?=GetMessage("S_TITLE2")?></p>     
<?
$inv_desc = base64_encode(GetMessage("S_PAYMENT").$arResult["ID"]);
$m_key = S_KEY;
// регистрационная информация (логин, пароль #1) // registration info (login, password #1) 
$mrh_login = "fromfoto"; 
$mrh_pass1 = "7Qq9hoK9WU"; 
$shp_item = 7; 
$culture = $land; 
$encoding = "utf-8";
$IncCurrLabel = Get_currency_robo($ar_clip['PROPERTY_CURRENCY_ENUM_ID']);  
 
$crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"); // HTML-страница с кассой // ROBOKASSA HTML-page ?>
<br />
<div class="html_form">
<?
	print "<html><script language=JavaScript ". "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormV.js?". "MrchLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id". "&Description=$inv_desc&SignatureValue=$crc&shpItem=$shp_item". "&Culture=$culture&Encoding=$encoding&IncCurrLabel=$IncCurrLabel'></script></html>";
?>
</div>
<br />
<p class="text-done"><?=GetMessage("S_TITLE5")?></p>
<p style="margin: auto 25%; padding: 17px; border-radius: 3px; color: #7f93b1; font-weight: bold;"><?=GetMessage("S_TITLE4")?></p>
<p class="text-done"><?=GetMessage("S_TITLE3")?></p>
<br />
<a class="button-slide" href="/fljvrFG/" style="line-height: 30px; height:30px;"><?=GetMessage("S_BACK")?></a>
<? endif; ?>
	</div>
</div>