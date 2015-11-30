<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>

<? if($_REQUEST['video_id']): ?>
<?
CModule::IncludeModule("iblock");

$arFilter = Array(
   "IBLOCK_ID"=>'30', 
   "ACTIVE"=>"Y", 
   "ID"=>$_REQUEST['video_id']
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array('PROPERTY_PREV_VIMEO'));
$ar_fields = $res->GetNext();

?>

<?=$ar_fields['~PROPERTY_PREV_VIMEO_VALUE']; ?>

<? endif; ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>