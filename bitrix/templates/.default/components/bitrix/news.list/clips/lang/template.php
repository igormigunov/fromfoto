<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//добавить класс?>
<?$this->SetViewTarget('add_class');?> tab<?$this->EndViewTarget();?> 

<div class="content-title bold-title">
	<?=GetMessage('FF_TITLE')?> 
	<p class="content-title-small"><?=GetMessage('FF_TITLE_DESCR')?></p>
</div>
<div class="tab-wrap">
	<ul class="tab-nav">
		<?foreach($arResult["SECTION"] as $arSection):?>
			<li><a href="#sect<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></a></li>
		<?endforeach;?>
	</ul>
	
	<?foreach($arResult["SECTION"] as $arSection):?>
		<div class="tab-container" id="sect<?=$arSection["ID"]?>">
		<?$cnt = 0;?>
		<?foreach($arResult["ELEMENT_SECTION"][$arSection["ID"]] as $arElement):?>
			<?$arItem = $arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]];?>
			<div class="tab-item<?if($cnt%2 == 1):?> margin-right-0<?endif;?>">
				<div class="tab-item-img" _id="<?=$arItem["ID"]; ?>">
					<? if($arParams['PICT_LOGICK']): ?>
						<img style="top: 50%;" class="play img_video" src="/images/play.png" alt="">
						<img style="top: 50%;" class="play_hover img_video"  src="/images/play_hover.png" alt="">
						<?
							$newWidth = 666;
							$newHeight = 376;
							$renderImage = array();
							$renderImage['src'] = "/images/tab-item.jpg";
							if($arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]]["PREVIEW_PICTURE"]){
								$renderImage = CFile::ResizeImageGet($arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]]["PREVIEW_PICTURE"], Array("width" => $newWidth, "height" => $newHeight), BX_RESIZE_IMAGE_PROPORTIONAL);
							}
							if(!file_exists($_SERVER['DOCUMENT_ROOT'].$renderImage['src'])){
								$renderImage['src'] = "/images/tab-item.jpg";
							}
						?>
						<img src="<?=$renderImage['src']; ?>" alt="">
					<? else: ?>
						<?=$arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]]['PROPERTIES']['PREV_VIMEO']['~VALUE'];?>
					<? endif; ?>
				</div>
				<? /*<div class="like">
					<span class="like-button"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon-like.png" alt=""></img></span>
					<input type="text" value="" readonly>
				</div> */?>           
				<a href="/new_create_video/?video_id=<?=$arElement["IBLOCK_ELEMENT_ID"]?><?if($arSection["BEST"] == "Y"):?>&best=Y<?endif;?>" class="tab-item-title"><?=$arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]]["NAME"]?></a>
				<p><?=$arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]]["PREVIEW_TEXT"]?></p>
				<span class="tab-item-info"><?=$arResult["ELEMENT"][$arElement["IBLOCK_ELEMENT_ID"]]['PROPERTIES']['INFO_ABOUT']['VALUE'];?></span>
				<div class="like">
					<span class="price-box">
						<?if($arItem['PROPERTIES']['COST']['VALUE']):?>
							<?=$arItem['PROPERTIES']['COST']['VALUE'];?> <?=$arResult["CURRENCY"][$arItem['PROPERTIES']['CURRENCY']['VALUE_ENUM_ID']]?>
						<?else:?>
							<?=GetMessage('FF_FREE')?>
						<?endif;?>
					</span>
				</div>            
				<a href="/new_create_video/?video_id=<?=$arElement["IBLOCK_ELEMENT_ID"]?><?if($arSection["BEST"] == "Y"):?>&best=Y<?endif;?>" class="button-tab"><?=GetMessage('FF_BUTTON1')?></a>
			</div>
    	    <?$cnt++;?>
		<?endforeach;?>
		</div>
	<?endforeach;?>
</div><!-- tab-wrap -->
