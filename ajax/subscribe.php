<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$popuptext = "Ошибка. Попробуйте повторить запрос позже.";
CModule::IncludeModule("subscribe");
// если есть post запрос с почтой то исполняем код
if($_POST["email"]) {
	
	if(!check_post_email($_POST["email"])){
		echo "Ошибка. Неверный email.";
		exit();
	}
	
    $EMAIL = $_POST["email"];
    /* получим значение пользователя */
    if ($USER->IsAuthorized()){
        global $USER;
        $USER = $USER->GetID() ;
    }
    else {
       $USER = NULL ;
    }
    /* определим активные рубрики подписок */
    $RUB_ID = array();
    $rub = CRubric::GetList(array(), array("ACTIVE"=>"Y"));
    while($rub->ExtractFields("r_")):
     $RUB_ID = array($r_ID) ;
    endwhile;
  
    /* создадим массив на подписку */
    $subscr = new CSubscription;
    $arFields = Array(
        "USER_ID" => $USER,
        "FORMAT" => "html/text",
        "EMAIL" => $EMAIL,
        "ACTIVE" => "Y",
        "RUB_ID" => $RUB_ID,
        "SEND_CONFIRM" => "N"
    );
    $idsubrscr = $subscr->Add($arFields);
  
    if($idsubrscr) {
      $popuptext =  $EMAIL .' подписан на рассылку';
    }
    else {
      $popuptext =   $EMAIL .' уже был подписан на рассылку';
    }
}
echo $popuptext; 
?>