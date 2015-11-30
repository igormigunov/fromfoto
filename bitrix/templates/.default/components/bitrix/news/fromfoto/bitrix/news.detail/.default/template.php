<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->SetViewTarget("add_class"); ?> article<? $this->EndViewTarget(); ?>
<div class="content-title bold-title article-title" style="padding-top: 10px; line-height: 1em; margin: 0 0 35px; width: 94%;">
	<?echo $arResult["NAME"];?>
</div>
<div class="article-text" style="width: 94%;">
	<?echo $arResult["DETAIL_TEXT"];?>
</div>


