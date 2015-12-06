<?php
/**
 * Created by PhpStorm.
 * User: igor migunov
 * Date: 03.12.2015
 * Time: 21:16
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$shareID=intval($_REQUEST["share_id"]);
$shareKey=$_REQUEST["shareKey"];
if($shareID>0 and helpertools::getShareKey($USER->getID())==$shareKey){
    if(helpertools::progressClip($shareID)){
        echo json_encode(array("ID"=>$shareID,"MESSAGE"=>"ok"));
    }else{
        echo json_encode(array("MESSAGE"=>"Неизвестная ошибка!!!"));
    }
    die();
}elseif(helpertools::getShareKey($USER->getID())!=$shareKey){
    echo json_encode(array("MESSAGE"=>"Ошибка сигнатуры!!!"));
    die();
}else{
    echo json_encode(array("MESSAGE"=>"Неизвестная ошибка!!!"));
    die();
}
