<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("iblock");
if(!$_POST["PRODUCT_ID"]){
	exit(")");
}
$PRODUCT_ID = intval($_POST["PRODUCT_ID"]);
$arFilter = Array(
				"IBLOCK_TYPE"=>"clips", 
				"IBLOCK_ID"=>"33",
				"ID"=>$PRODUCT_ID
			);
		
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("PROPERTY_READY_FACE"));
$clip_stage_2 = $res->GetNext();
if(isset($clip_stage_2["PROPERTY_READY_FACE_VALUE"]) && ($clip_stage_2["PROPERTY_READY_FACE_VALUE"] == "10")){
	exit("ok");
}

?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>