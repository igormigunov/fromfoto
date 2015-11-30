<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if($arResult["ITEMS"]): ?>

<ul class="map-menu">

	<? foreach($arResult["ITEMS"] as $arItem):?>
		<li><a href="<?=SITE_DIR?>create_video/?video_id=<?=$arItem['ID'];?>"><?=$arItem['NAME'];?></a></li>
    <? endforeach; ?>

</ul>

<? endif; ?>