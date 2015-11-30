<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["ITEMS"]): ?>
<?
$newWidth = 24;
$newHeight = 24;
$num = (isset($_REQUEST['start']))?$_REQUEST['start']:0;

?>
<ul class="social">
<? foreach($arResult["ITEMS"] as $arItem):?>
<?
	$renderImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
?>
<li>
	<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']; ?>" title="<?=$arItem['NAME'];?>" class="social-target" target="_blank">
		<img src="<?=$renderImage['src']; ?>" alt="<?=$arItem['NAME'];?>" class="img-responsive">
	</a>
</li>
<? endforeach; ?>
</ul>
<? endif; ?>