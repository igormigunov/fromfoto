<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule("iblock");
$arFilter = Array(
   "IBLOCK_ID"=>"36", 
   "ACTIVE"=>"Y", 
   "ID"=>"7891"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
$ar_data = $res->GetNext();

$APPLICATION->SetPageProperty("description", $ar_data['PREVIEW_TEXT']);
$APPLICATION->SetPageProperty("title", $ar_data['NAME']);
$APPLICATION->SetTitle($ar_data['NAME']);

if($_SERVER['HTTP_REFERER'] && preg_match("/ok\.ru/", $_SERVER['HTTP_REFERER'])){
	LocalRedirect('/');
}
?> 
 
<div class="video main">
	<img src="<?=CFile::GetPath($ar_data['PREVIEW_PICTURE']); ?>" class="img-for-mobile" style="display: block;"  />
</div>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>