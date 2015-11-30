<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)):?>

<?
foreach($arResult as $arItem):
?>

	<?if($arItem["LINK"] == "/profile/" && !$USER->IsAuthorized()):?>
		<a class="<? if($arItem["SELECTED"]):?> active<? endif;?>" href="<?=$arItem["LINK"]?>">авторизация</a>
	<?else:?>
		<a class="<? if($arItem["SELECTED"]):?> active<? endif;?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
	<? endif;?>

<? endforeach; ?>

<? endif;?>
