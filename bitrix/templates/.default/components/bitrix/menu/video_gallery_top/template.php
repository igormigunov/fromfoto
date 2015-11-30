<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="nav navbar-nav">
<?
$previousLevel = 0;
$num = 0;
foreach($arResult as $arItem):
$num++;
?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
			<li class="navbar-item navbar-item-menuparent<? if($arItem["SELECTED"]):?> active<? endif;?>">
				<a href="<?=$arItem["LINK"]?>" class="navbar-item-target"><?=$arItem["TEXT"]?> <i class="navbar-item-menuparent-icon fa fa-chevron-down"></i></a>
				<ul class="navbar-submenu">

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>
				<li class="<? if($arItem["DEPTH_LEVEL"]>1):?>navbar-sub-item<? else: ?>navbar-item<? endif ?><? if($arItem["SELECTED"]):?> active<? endif;?>">
					<a class="<? if($arItem["DEPTH_LEVEL"]>1):?>navbar-sub-item-target<? else: ?>navbar-item-target<? endif ?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				</li>
		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>
