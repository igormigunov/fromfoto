<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
     
    global $APPLICATION;
     
    $aMenuLinksExt = $APPLICATION->IncludeComponent(
    "my:menu.sections",
    "",
    Array(
    "IS_SEF" => "N",
	"SEF_BASE_URL" => "/clips/",
    "IBLOCK_TYPE" => "clips", 
    "IBLOCK_ID" => "30", 
    "SECTION_URL" => "/clips/#SECTION_CODE_PATH#/",
    "DEPTH_LEVEL" => "2", 
    "CACHE_TYPE" => "N", 
    "CACHE_TIME" => "3600"
    ),
    false
    );
    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?> 