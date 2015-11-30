<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSection = array();
$arSectionID = array();
$arSort = array();

foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arSectionID[] = $arElement["ID"];
	$arResult["ELEMENT"][$arElement["ID"]] = $arElement;
}

$result = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>'1', 'UF_BEST'=>'1'), false, array("ID"));
if($arFields = $result->GetNext()){
	$best_id = $arFields["ID"];
}

//выборка элементов
$arSelect = Array("ID", "NAME", "SORT", "ACTIVE", "IBLOCK_ELEMENT_ID");
$arFilter = $arSectionID;
$result = CIBlockElement::GetElementGroups($arFilter, true, $arSelect);
while($arFields = $result->GetNext())
{
	if($arFields["ACTIVE"] == "Y")
	{
		if($arFields["ID"] == $best_id)
		{
			$arFields["BEST"] = "Y";
		}
		$arSection[$arFields["ID"]] = $arFields;
		$arSort[$arFields["ID"]] = $arFields["SORT"];
		
		$arFields["SORT"] = $arResult["ELEMENT"][$arFields["IBLOCK_ELEMENT_ID"]]["SORT"];
		$arElementSection[$arFields["ID"]][] = $arFields;
	}
}

array_multisort($arSort, SORT_ASC, $arSection);
foreach($arElementSection as &$arLevel)
{
	foreach ($arLevel as $key => $row)
	{
		$sort[$key]  = $row['SORT'];
		array_multisort($sort, SORT_ASC, $arLevel);
	}
	unset($sort);
}

$arResult["CURRENCY"]["3"] = "рублей"; 
$arResult["CURRENCY"]["4"] = "$"; 
$arResult["CURRENCY"]["14"] = "EUR";
 
$arResult["SECTION"] = $arSection;
$arResult["ELEMENT_SECTION"] = $arElementSection;
?>