<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/common_data.php");?>
<?

$user = new CUser;
$rsUser = CUser::GetByLogin($_POST['email_vk']);
if($arUser = $rsUser->Fetch()){
	$user_id = $arUser['ID'];
}else{
	$password = rand(999999999,99999999999999999);
	$arFields = Array(
		"NAME"              => $_REQUEST['email_vk'],
		"EMAIL"             => $_REQUEST['email_vk'],
		"LOGIN"             => $_REQUEST['email_vk'],
		"ACTIVE"            => "Y",
		"GROUP_ID"          => array(3,5,4),
		"PASSWORD"          => $password,
		"CONFIRM_PASSWORD"  => $password
	);

	$user_id = $user->Add($arFields);
	if (intval($user_id) > 0){
	}
	else
		$errors[] = $user->LAST_ERROR;
}
if(!$errors){

	$el = new CIBlockElement;



	$PROP = array();

	$PROP[110] = $_POST['video_id'];
	
	$PROP[185] = $count_video;
	
	$PROP[177] = $_POST['no_logo'] ? 37:0;
	
	$PROP[107] = $_POST['email_vk'];
	$PROP[106] = $_POST['email_vk'];
	$PROP[209] = $user_id;

//определить сколько заплачено
		$pay_fast = 0;
		$arFilter = Array(
   			"IBLOCK_TYPE"=>"clips", 
			"IBLOCK_ID"=>"33",
   			"ACTIVE"=>"Y", 
   			"PROPERTY_USER"=>$PROP[209],
   			"PROPERTY_TELL_FRIENDS"=>49,
 			">DATE_CREATE"=>date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,1,1,2015)),
   		);
		
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID"));
		
		while($pay_fas_co = $res->GetNext()){
			$pay_fast = $pay_fast + 1;
		}
		
		if($pay_fast%2)
		{
			$PROP[218] = 49;
			$uploaddir_texts = '/home/admin/zakaz/'.$_REQUEST["InvId"].'_33/';
			$fp = fopen($uploaddir_texts.'paid.txt', 'w');
			fwrite($fp, "1");
			fclose($fp);
		}
//-----------------
	
	$arLoadProductArray = Array(

 	 "MODIFIED_BY"    => 1,

 	 "IBLOCK_SECTION_ID" => false,

 	 "IBLOCK_ID"      => 33,

 	 "PROPERTY_VALUES"=> $PROP,

 	 "NAME"           => $_POST['email_vk'].date("d-m-Y"),

 	 "CODE"         => $_SESSION["HASH_CODE"],
	 
 	 "ACTIVE"         => "Y"

 	 );



	if($PRODUCT_ID = $el->Add($arLoadProductArray)){
		$_SESSION['PRODUCT_ID'] = $PRODUCT_ID;
		$arFields = array(

			"NAME" => $_POST['email_vk'],
			
			"LINK_TO" => 'http://'.$_SERVER['HTTP_HOST'].'/fljvrFG/prev.php?PRODUCT_ID='.$PRODUCT_ID,

  			"EMAIL" => $_POST['email_vk']

			);
		CEvent::SendImmediate("ORDER_CLIP", "s1", $arFields);
		echo "1";

	}

	else{

		echo "<div class=\"errors\">Неизвестная ошибка. Повторите позже.</div>";

	}
		


}else{

	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";

}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>