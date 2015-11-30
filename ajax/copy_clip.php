<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? 

if(intval($_REQUEST['ID'])){
	$_REQUEST['ID'] = intval($_REQUEST['ID']);
	if(file_exists("/home/admin/wait_zakaz/".$_REQUEST['ID']."_33/")){
		rename("/home/admin/wait_zakaz/".$_REQUEST['ID']."_33/", "/home/admin/zakaz/".$_REQUEST['ID']."_33/");
	}
	CModule::IncludeModule("iblock");
	$el = new CIBlockElement;
	$arLoadProductArray = Array(
 		"MODIFIED_BY"    => 1,
		"DATE_CREATE"    => ConvertTimeStamp(time(), "FULL"),
		"IBLOCK_SECTION" => false,
		"ACTIVE"         => "Y"
	);
	echo $el->Update($_REQUEST['ID'], $arLoadProductArray);
}?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>