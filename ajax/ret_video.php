<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if(!($id = intval($_REQUEST['_id']))){
	exit(":)");
}
CModule::IncludeModule("iblock");
$db_props = CIBlockElement::GetProperty(30, $id, Array("sort"=>"asc"), Array("CODE"=>"PREV_VIMEO"));
$ar_props = $db_props->Fetch();
echo preg_replace("/autoplay=0/","autoplay=1",$ar_props['VALUE']);
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>