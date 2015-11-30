<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?><?

CModule::IncludeModule("iblock");
$user_id = 0;
if(isset($_POST['email'])){
	$user = new CUser;
	$rsUser = CUser::GetByLogin($_POST['email']);
	if($arUser = $rsUser->Fetch()){
		$user_id = $arUser['ID'];
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

		$user_id = $user->Add($arFields);
		if (!(intval($user_id) > 0)){
   			echo $user->LAST_ERROR;
			exit('<br />');
		}
	}

}

if(!$user_id || !$_POST['arItemId']){
	echo 'Неизвестная ошибка, повторите запрос позже...';
	exit('<br />');
}

$arFilter = array(
	"IBLOCK_TYPE"=>"clips", 
	"ID" => $_POST['arItemId'],
);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TYPE_CLIP","PROPERTY_USER_EMAIL", "PROPERTY_PAID", "PROPERTY_USER_NAME","PROPERTY_USER","PROPERTY_NO_LOGO","PROPERTY_VIDEO_COUNT","PROPERTY_TELL_FRIENDS"));
$clip = $res->GetNext();
if(!$clip){
	echo 'Неизвестная ошибка, повторите запрос позже...';
	exit('<br />');
}
$PROP = array();
$PROP[109] = ($clip['PROPERTY_PAID_VALUE'])?5:0;
$PROP[110] = $clip['PROPERTY_TYPE_CLIP_VALUE'];
$PROP[107] = $_POST['email'];
$PROP[106] = $_POST['email'];
$PROP[185] = $clip['PROPERTY_VIDEO_COUNT_VALUE'];
$PROP[209] = $user_id;
$PROP[218] = 0;
$PROP[177] = ($clip['PROPERTY_NO_LOGO_VALUE'])?37:0;

$arLoadProductArray = Array(
	"MODIFIED_BY"    => 1,
 	"IBLOCK_SECTION" => false,
 	"PROPERTY_VALUES"=> $PROP,
 	"ACTIVE"         => "Y",
);

$el = new CIBlockElement;

$res = $el->Update($clip['ID'], $arLoadProductArray);
echo'1';

?><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>