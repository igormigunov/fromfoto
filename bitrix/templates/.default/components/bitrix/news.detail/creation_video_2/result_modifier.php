<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//выбор фотографий для данного клипа
$arResult["PHOTO"] = array();

$arFilter = Array(
   "IBLOCK_ID"=>"31", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($arResult['PROPERTIES']['PHOTO']['VALUE'])? $arResult['PROPERTIES']['PHOTO']['VALUE']:-1
   );
$arSelect = array("PROPERTY_SIZE","PROPERTY_SECOND","PROPERTY_NO_VIDEO","ID","NAME");
$result = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);

while($arFields = $result->GetNext())
{
  $arResult["PHOTO"][] = $arFields;
}

//выбор текстов для данного клипа
$arResult["TEXTS"] = array();

$arFilter = Array(
   "IBLOCK_ID"=>"32", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($arResult['PROPERTIES']['TEXTS']['VALUE'])? $arResult['PROPERTIES']['TEXTS']['VALUE']:-1
   );
$arSelect = array("PROPERTY_COUNT_SYMBOLS","PROPERTY_SECOND","PROPERTY_SIGN","ID","NAME","PROPERTY_TIME_CLIP","PREVIEW_PICTURE");
$result = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
while($arFields = $result->GetNext())
{
  $arResult["TEXTS"][] = $arFields;
}

?>