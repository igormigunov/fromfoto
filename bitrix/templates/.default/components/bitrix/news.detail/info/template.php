<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$newWidth = 700;
$newHeight = 578;
$renderImage = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
?>	

<div id="menu-about" class="block-content about-wrapper block-padding-large" style="padding-top: 65px; background:url('<?=$renderImage['src'];?>');background-position: right bottom;background-repeat: no-repeat;background-size: 60% auto;">
                        <div class="about">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class="block-title"><?=$arResult['NAME'];?></h2>

                                    <p class="slogan about-slogan">
                                        <?=$arResult['PREVIEW_TEXT'];?>
                                    </p>

                                    <a class="btn btn-fancy popup_about" title="<?=$arResult['NAME']?>" href="#inline_cont<?=$arResult['ID']?>">
                                        <span><?=GetMessage("S_MORE")?></span>
                                    </a>
                                    <div style='display:none'>
			<div id='inline_cont<?=$arResult['ID']?>' style='background:#fff;'>
				<?=$arResult['DETAIL_TEXT']?>
			</div>
		</div>
                                </div><!-- /.col-sm-6 -->

                                <div class="about-picture col-sm-6"></div>
                            </div><!-- /.row -->
                        </div><!-- /.about -->
                    </div>
                    
                    
<script>
$(".popup_about").colorbox({inline:true, width:"100%"});
</script>