<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? global $USER; ?>
<?
    if(empty($arParams["CHEKCODE"])){
    	$arParams["CHEKCODE"] = '0';
    }
?>
<?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "fromfoto_cr_n", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"N")
);?>