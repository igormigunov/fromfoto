<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("iblock");

$id = explode("_",$_REQUEST["zakaz1"]);
$clip_id = $id[0];
if(!$clip_id){
	exit("1");
}

$arFilter = Array(
   "IBLOCK_TYPE"=>"clips", 
   "ACTIVE"=>"Y", 
   "ID"=>$clip_id
);

$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TYPE_CLIP","PROPERTY_USER_EMAIL", "PROPERTY_PAID", "PROPERTY_USER_NAME","PROPERTY_USER","PROPERTY_NO_LOGO","PROPERTY_VIDEO_COUNT","PROPERTY_TELL_FRIENDS", "PROPERTY_PREVIEW_VIDEO"));
if($clip = $res->GetNext()){
	$PROP[109] = ($clip['PROPERTY_PAID_VALUE'])?5:0;
	$PROP[110] = $clip['PROPERTY_TYPE_CLIP_VALUE'];
	$PROP[107] = $clip['PROPERTY_USER_EMAIL_VALUE'];
	$PROP[107] = $arUser['NAME'];
	$PROP[106] = $clip['PROPERTY_USER_NAME_VALUE'];
	$PROP[106] = $arUser['EMAIL'];
	$PROP[185] = $clip['PROPERTY_VIDEO_COUNT_VALUE'];
	$PROP[209] = $clip['PROPERTY_USER_VALUE'];
	$PROP[218] = $clip['PROPERTY_TELL_FRIENDS_ENUM_ID'];
	$PROP[177] = ($clip['PROPERTY_NO_LOGO_VALUE'])?37:0;
	$PROP[226] = 10;
	
	$arLoadProductArray = Array(
		"MODIFIED_BY"    => 1,
		"IBLOCK_SECTION" => false,
		"PROPERTY_VALUES"=> $PROP,
		"ACTIVE"         => "Y"
	);

	$el = new CIBlockElement;
	if($res = $el->Update($clip_id, $arLoadProductArray)) {
		echo 'получено';
	}else{
		echo $el->LAST_ERROR;
	}
}

?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>