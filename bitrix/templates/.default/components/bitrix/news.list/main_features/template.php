<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["ITEMS"]): ?>
<?
$newWidth = 80;
$newHeight = 80;
$num = 0;
$class = array("fullwidth-left features-one","features-two","features-three fullwidth-right");
?>


<div class="block-content features-wrapper">
<div class="features">
	<div class="row">
    	<? foreach($arResult["ITEMS"] as $arItem):?>
        <? if($num<3):?>
        <?
			$renderImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
		?>
        	<div class="feature-item col-sm-4">
				<div class="<?=$class[$num];?>">
					<div class="center">
						<a title="<?=$arItem['NAME'];?>" class="popup_features show_steps" href="#menu-choose">
							<i class="features-icon fa fa-rocket without_content_ico_<?=$arItem['ID'];?>" data-animation="bounce"></i>
						</a>
					</div><!-- /.center -->

					<h2 class="feature-item-title center"><?=$arItem['NAME'];?></h2>
					<p class="feature-item-content center"><?=$arItem['PREVIEW_TEXT'];?></p>
                    
                    <div style='display:none'>
						<div id='inline_features<?=$arItem['ID']?>' style='background:#fff;'>
							<?=$arItem['DETAIL_TEXT']?>
						</div>
					</div>
                    
                    <style>
						.fa-rocket.without_content_ico_<?=$arItem['ID'];?>:before{
							content:url('<?=$renderImage['src']; ?>') !important;
						}
					</style>
                    
				</div><!-- /.features-one -->
			</div>
        <? $num++; ?>
        <? endif; ?>
        <? endforeach; ?>                        
        </div>
</div>
</div>                    
<script>
//$(".popup_features").colorbox({inline:true, width:"100%"});
</script>                           
<? endif;?>