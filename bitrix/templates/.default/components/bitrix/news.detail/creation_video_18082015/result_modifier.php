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


/**
 * Bitrix vars
 *
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $arParams
 * @var array $arResult
 * @var array $arLangMessages
 * @var array $templateData
 *
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $parentTemplateFolder
 * @var string $templateName
 * @var string $componentPath
 *
 * @var CDatabase $DB
 * @var CUser $USER
 * @var CMain $APPLICATION
 */

// Прямая сортировка, чтобы последний элемент был справа от текущего, при обратной будет наоборот, слева.
$arSort = array(
    'SORT' => 'ASC',
    'ID' => 'ASC',
);

// минимальные поля ID, NAME, DETAIL_PAGE_URL
$arSelect = array(
    'ID',
    'NAME',
    'DETAIL_PAGE_URL',
    //'DATE_CREATE',
    //'DATE_ACTIVE_FROM',
    'PREVIEW_PICTURE',
    //'DETAIL_PICTURE',
);

// выбираем активные элементы из нужного инфоблока по фильтру, вообще фильтр должен совпадать с фильтром компонента
// иначе могут в пагинацию попасть левые элементы инфоблока, которых не будет на сайте.
$arFilter = array(
    'IBLOCK_ID'             => $arParams['IBLOCK_ID'],
    //'SECTION_CODE'          => $arParams['SECTION_CODE'],
    //'SECTION_CODE'          => $arResult['SECTION']['CODE'],
    'PROPERTY_IN_SIMPLE_REDACTOR'	=> '52',
    'ACTIVE'                => 'Y',
    'ACTIVE_DATE'           => 'Y',
    'SECTION_ACTIVE'        => 'Y',
    'SECTION_GLOBAL_ACTIVE' => 'Y',
    'INCLUDE_SUBSECTIONS'   => 'Y',
    'CHECK_PERMISSIONS'     => 'Y',
    'MIN_PERMISSION'        => 'R',
);


// тут получим по 1 соседу с каждой стороны от текущего элемента
$arNavParams = array(
    'nPageSize'  => 1,
    'nElementID' => $arResult['ID'],
);
$arElements     = Array();
$rsElements   = CIBlockElement::GetList($arSort, $arFilter, FALSE, $arNavParams, $arSelect);
if($arParams['DETAIL_URL'])
    $rsElements->SetUrlTemplates($arParams['DETAIL_URL']);

while($obElement = $rsElements->GetNextElement()) {
    $arElements[] = $obElement->GetFields();
}
//echo '<pre>';
//print_r($arElements);
//echo '</pre>';

// в $arResult['RIGHT_PAGE'] и $arResult['LEFT_PAGE']  массивы с информацией о соседних элементах для текущего
switch(count($arElements))
{
    case '3': //Сработает, когда справа и слева есть элементы
    {
        $RIGHT_PAGE = array_pop($arElements); // Последний элемент справа
        $LEFT_PAGE = array_shift($arElements); // Первый элемент слева

        $arResult['RIGHT_PAGE'] = Array(
            'NAME' => $RIGHT_PAGE['NAME'],
			'PREVIEW_PICTURE' => $RIGHT_PAGE['PREVIEW_PICTURE'],
            'URL'  => '/create_video/?video_id='.$RIGHT_PAGE['ID']
        );
        $arResult['LEFT_PAGE']  = Array(
            'NAME' => $LEFT_PAGE['NAME'],
			'PREVIEW_PICTURE' => $LEFT_PAGE['PREVIEW_PICTURE'],
            'URL'  => '/create_video/?video_id='.$LEFT_PAGE['ID']
        );
    }
    break;

    case '2': //Сработает либо на первом, либо на последнем элементе
    {
        $RIGHT_PAGE = array_pop($arElements); // Последний элемент справа
        $LEFT_PAGE = array_shift($arElements); // Первый элемент слева

        // тут проверяем, слева или справа будет текущий открытый элемент, его исключаем

        if($LEFT_PAGE["ID"] && $LEFT_PAGE["ID"] != $arResult["ID"])
        {
            $arResult['RIGHT_PAGE'] = Array();
            $arResult['LEFT_PAGE']  = Array(
                'NAME' => $LEFT_PAGE['NAME'],
				'PREVIEW_PICTURE' => $LEFT_PAGE['PREVIEW_PICTURE'],
                'URL'  => '/create_video/?video_id='.$LEFT_PAGE['ID']
            );
        }
        elseif($RIGHT_PAGE && $RIGHT_PAGE != $arResult["ID"])
        {
            $arResult['LEFT_PAGE'] = Array();
            $arResult['RIGHT_PAGE']  = Array(
                'NAME' => $RIGHT_PAGE['NAME'],
				'PREVIEW_PICTURE' => $RIGHT_PAGE['PREVIEW_PICTURE'],
                'URL'  => '/create_video/?video_id='.$RIGHT_PAGE['ID']
            );
        }
        else
        {
            $arResult['RIGHT_PAGE'] = Array();
            $arResult['LEFT_PAGE']  = Array();
        }
    }
    break;

    default: //Если что-то пойдет не так, постраничка выводиться не будет
    {
        $arResult['RIGHT_PAGE'] = Array();
        $arResult['LEFT_PAGE']  = Array();
    }
}

?>