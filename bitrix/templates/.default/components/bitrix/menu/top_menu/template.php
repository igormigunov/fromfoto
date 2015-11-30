<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if (!empty($arResult)):?>
<menu>
<?
foreach($arResult as $arItem):
?>

	<? if($arItem["LINK"] == "/profile/" && !$USER->IsAuthorized()):?>
		<li><a class="<? if($arItem["SELECTED"]):?> active<? endif;?>" href="<?=$arItem["LINK"]?>"><span>авторизация</span></a></li>
	<? else:?>
		<li><a class="<? if($arItem["SELECTED"]):?> active<? endif;?>" href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
	<? endif;?>

<? endforeach; ?>
</menu>
<? endif;?>