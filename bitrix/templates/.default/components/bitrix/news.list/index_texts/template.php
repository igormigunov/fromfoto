<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["ITEMS"]): ?>
<? $num = 0; ?>
<? for($i=0; $i<20;$i++):?>
<? foreach($arResult["ITEMS"] as $arItem):?>	
<? $num++;?>
<div class="change_text ch_t_<?=$num;?>" style="<? if($num == 1): ?>display: block; z-index: 40; position: absolute; top: 0px; left: 0px; right: auto;<? endif;?> <? if($num >1): ?>display:none;<? endif;?>">
	<?=$arItem["PREVIEW_TEXT"]?>
</div>
<? endforeach; ?>
<? endfor; ?>
<? endif; ?>