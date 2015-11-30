<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->SetViewTarget("add_class"); ?> article<? $this->EndViewTarget(); ?>
<div class="content-title bold-title article-title" style="line-height: 1em; margin: 0 0 35px; width: 94%; padding-top: 10px;">
	О создании видео-презентаций онлайн.
</div>
<div class="article-text" style="width: 94%;">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="slide-table-item" style="padding: 0px;">
		<div class="slide-name">
			<a style="font-family: 'One_Days'; font-size: 15px;" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]; ?></a>
		</div>
		<div style="clear: both;">
			<a style="color: #010101; text-decoration: none;" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["PREVIEW_TEXT"];?></a>
		</div>
	</div>
	<hr size="1" color="#efefef" align="center">


<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
