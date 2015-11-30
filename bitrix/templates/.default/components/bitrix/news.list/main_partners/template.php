<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["ITEMS"]): ?>
<?
$newWidth = 220;
$newHeight = 57;
$num = (isset($_REQUEST['start']))?$_REQUEST['start']:0;

?>
<div class="partners-items row">
<? foreach($arResult["ITEMS"] as $arItem):?>
<?
	$renderImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
?>
<div class="partner-item col-sm-3 col-xs-12 center">
	<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']; ?>" title="<?=$arItem['NAME'];?>" class="partner-target">
		<img src="<?=$renderImage['src']; ?>" alt="<?=$arItem['NAME'];?>" class="img-responsive">
	</a>
</div><!-- /.partner-item -->
<? endforeach; ?>
</div>
<? endif; ?>