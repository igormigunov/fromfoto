<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["ITEMS"]): ?>
<?
$newWidth = 60;
$newHeight = 60;
?>





<div class="row">
<div class="col-sm-10 col-sm-offset-1">
    <div class="services-list row">
    
         <? foreach($arResult["ITEMS"] as $arItem):?> 
         <?
			$renderImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
		?>
         	<div class="service col-sm-6">
            <div class="row">
                <div class="service-icon col-sm-4">
                    <div class="radial-icon-wrapper">
                        <div class="radial-icon">
                            <div class="radial-icon-inner">
                                <i class="fa fa-rocket without_content_ico_<?=$arItem['ID'];?>" data-animation="shake"></i>
                            </div><!-- /.radial-icon-inner -->
                        </div><!-- /.radial-icon -->
                    </div><!-- /.radial-icon-wrapper -->
                </div><!-- /.service-icon -->

                <div class="service-content col-sm-7">
                    <h2 class="service-title block-subtitle"><?=$arItem['NAME'];?></h2>

                    <p>
                        <?=$arItem['PREVIEW_TEXT'];?>           
                    </p>
                </div><!-- /.service-content -->
            </div><!-- /.row -->
        </div>
        
        <style>
			.fa-rocket.without_content_ico_<?=$arItem['ID'];?>:before{
				content:url('<?=$renderImage['src']; ?>') !important;
			}
		</style>

         
         
         <? endforeach; ?>                          
    
    
    
    
    
    </div><!-- /.services-list -->
</div>
</div>




















<? endif; ?>


