<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
exit();
if(CModule::IncludeModule("iblock")){
	$arSelect = Array(
		"ID", 
		"IBLOCK_ID",
		"PREVIEW_TEXT",		
		"NAME", 
		"DATE_CREATE", 
		"PROPERTY_USER_EMAIL", 
		"PROPERTY_USER_NAME", 
		"PROPERTY_PAID", 
		"PROPERTY_TELL_FRIENDS", 
		"PROPERTY_ALREADY_SEND",
		"TELL_FRIENDS", 
		"PROPERTY_FILE_LINK",
		"PROPERTY_USER",
	);
	$arFilter = array(
		"IBLOCK_ID" => 33,
		"!PROPERTY_FILE_LINK" => '',
		">DATE_CREATE" => ConvertTimeStamp(time()-3600*40, "FULL"),
	);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	$el = new CIBlockElement;
	echo '<pre>';
	while($row = $res->GetNext())
	{
		if(((($row['PROPERTY_PAID_VALUE'] || $row['PROPERTY_TELL_FRIENDS_VALUE']) && (strtotime($row['DATE_CREATE'])+2*3600) < time() )
			|| (strtotime($row['DATE_CREATE'])+24*3600) < time())
			&& $row['PREVIEW_TEXT'] != 'send'
		){

			$arLoadProductArray = Array(
				"MODIFIED_BY"    	=> 1, 
				"IBLOCK_SECTION" 	=> false,
				"PREVIEW_TEXT"		=> 'send',
				"ACTIVE"         	=> "Y",
			);

			$PRODUCT_ID = $row['ID'];
			$reslt = $el->Update($PRODUCT_ID, $arLoadProductArray);
			
			$rsUser = CUser::GetByID($row['PROPERTY_USER_VALUE']);
			$arUser = $rsUser->Fetch();
			
			$arFields = array(
				"NAME" => $arUser['NAME'],
				"EMAIL" => $arUser['EMAIL'],
				"LINK_CLIP" => 'http://'.$_SERVER['HTTP_HOST'].'/clip/?num='.$ids[0],
				"LINK" => 'http://'.$_SERVER['HTTP_HOST'].'/fljvrFG/',

			);		 
			$site_id = "s1";
			$TYPE_ORD = ($row['PROPERTY_PAID_VALUE']) ? "BEST_CLIP_READY":"CLIP_READY";
			if($arUser['EMAIL']){
				CEvent::SendImmediate($TYPE_ORD, $site_id, $arFields);
			}
			print_r($row);
		}
	}
	echo '</pre>';
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>