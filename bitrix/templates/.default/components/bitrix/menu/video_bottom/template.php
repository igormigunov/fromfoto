<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="nav">
<? foreach($arResult as $arItem): ?>
	<li class="item"><a class="item-target" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<? endforeach ?>
</ul>
<?endif?>