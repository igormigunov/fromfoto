<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
/*
CModule::IncludeModule("iblock");

if(!empty($_REQUEST['chekcode'])){
	$arFilter = Array(
	   "IBLOCK_ID"=>"33", 
	   "ACTIVE"=>"Y", 
	   "=CODE"=>($_REQUEST['chekcode'])? $_REQUEST['chekcode']:-1
	   );
	$arSelect = array("PROPERTY_USER","ID","NAME");
	$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter,false,false,$arSelect);
	$currUser = -1;
	while($ar_fields = $res->GetNext())
	{
	  $currUser = $ar_fields["PROPERTY_USER_VALUE"];
	}
	
	$rsUser = CUser::GetByID($currUser);
	$arUser = $rsUser->Fetch();
	if(empty($arUser["LOGIN"]) || $arUser["LOGIN"] != $_POST['email'])
	{
		echo "Неверный код !";
		exit();
	};	
}
*/

if(isset($_POST['email'])){
	$user = new CUser;
	$rsUser = CUser::GetByLogin($_POST['email']);
	if($arUser = $rsUser->Fetch()){
		$user->Authorize($arUser['ID'], false);
    	echo "1";
	}else{
		$password = rand(999999999,99999999999999999);
		$arFields = Array(
  			"NAME"              => $_REQUEST['email'],
  			"EMAIL"             => $_REQUEST['email'],
  			"LOGIN"             => $_REQUEST['email'],
  			"ACTIVE"            => "Y",
  			"GROUP_ID"          => array(3,5,4),
  			"PASSWORD"          => $password,
  			"CONFIRM_PASSWORD"  => $password
		);

		$ID = $user->Add($arFields);
		if (intval($ID) > 0){
			//отправка сообщения
			CEvent::SendImmediate("SEND_TO_USER_AFTER_REG", "s1", $arFields);
			$user->Authorize($ID, false);
    		echo "1";
		}
		else
   			echo $user->LAST_ERROR;
	}

}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>