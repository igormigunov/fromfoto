<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult["ITEMS"]): ?>
<?
$newWidth = 400;
$newHeight = 400;
$num = (isset($_REQUEST['start']))?$_REQUEST['start']:0;

?>

	<div class="row" <? if($num):?> style="margin-top:20px"<? endif;?>>
		<? foreach($arResult["ITEMS"] as $arItem):?>	
        	<? if($num<3+$_REQUEST['start'] && isset($arResult["ITEMS"][$num])):?>
            
        	<?
				$renderImage = CFile::ResizeImageGet($arResult["ITEMS"][$num]['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
			?>	
                                    <div class="post-box-wrapper col-sm-4">
                                        <div class="post-box">
                                            <div class="post-box-image">
                                                <a class="ajax_news" title="<?=$arResult["ITEMS"][$num]['NAME']?>" href="<?=$arResult["ITEMS"][$num]['DETAIL_PAGE_URL']?>" class="post-box-image-taget">
                                                    <img src="<?=$renderImage['src']; ?>" alt="<?=$arResult["ITEMS"][$num]['NAME']?>" class="img-reponsive">
                                                </a>
                                                
                                                <div style='display:none'>
			<div id='inline_cont<?=$arResult["ITEMS"][$num]['ID']?>' style='background:#fff;'>
				<?=$arResult["ITEMS"][$num]['DETAIL_TEXT']?>
			</div>
		</div>
                                                
                                            </div><!-- /.post-box-image -->

                                            <div class="post-box-content">
                                                <h3 class="post-box-title">
                                                    <a class="ajax_news" title="<?=$arResult["ITEMS"][$num]['NAME']?>" href="<?=$arResult["ITEMS"][$num]['DETAIL_PAGE_URL']?>"><?=$arResult["ITEMS"][$num]['NAME']?></a>
                                                </h3>

                                                <div class="post-box-author">
                                                    <? /*if(trim($arResult["ITEMS"][$num]['PROPERTIES']['SOURCE']['VALUE'])): ?><?=$arResult["ITEMS"][$num]['PROPERTIES']['SOURCE']['VALUE']; ?> <span class="separator">/</span> <? endif; */?><span class="date"><?=$arResult["ITEMS"][$num]["DISPLAY_ACTIVE_FROM"]?></span>
                                                 </div><!-- /.post-box-author -->

                                                <p>
                                                    <?=$arResult["ITEMS"][$num]["PREVIEW_TEXT"]?> 
                                                </p>
                                                <br /> 
                                                    <a class="ajax_news" title="<?=$arResult["ITEMS"][$num]['NAME']?>" href="<?=$arResult["ITEMS"][$num]['DETAIL_PAGE_URL']?>"><?=GetMessage("S_MORE")?></a>

                                                <? /*<div class="post-box-meta">
                                                    <div class="row">
                                                        <div class="post-box-comments col-sm-6">
                                                            <a href="#">167 Comments</a>
                                                        </div><!-- /.post-box-comments -->

                                                        <div class="post-box-category col-sm-6">
                                                            <a href="#">Video</a> Category
                                                        </div><!-- /.post-box-category -->
                                                    </div><!-- /.row -->
                                                </div><!-- /.post-box-meta -->
												*/?>
                                            </div><!-- /.post-box-content -->
                                        </div><!-- /.post-box -->
                                    </div><!-- /.post-box-wrapper -->
	<? $num++; ?>
    <? endif;?>
	<? endforeach; ?>
                                    
                                    <!-- /.post-box-wrapper -->                                    
                                </div><!-- /.row -->
<? endif; ?>
<? if(sizeof($arResult["ITEMS"])>$num):?>
<h2 class="block-title center more_news" style="margin: 30px 0 0px 0px;"><a onclick="return 1;" class="more_news_a" href="<?=SITE_DIR?>news/ajax/?start=<?=$num;?>"><?=GetMessage("S_SHOW_MORE")?></a></h2>


<script>
	$('.more_news_a').unbind("click");
	$('.more_news_a').click(function(event){
		event.preventDefault();
		_this = $(this);
		_this.html('<?=GetMessage("S_WAIT")?>');
		$.get(_this.attr('href'), function(data) {	
			_this.parent('h2').remove();
			$('.news_add').append(data);	
		});
		_this.unbind("click");
		_this.click(function(event){event.preventDefault();return false;});
	});
	
</script>
<? endif;?>
<script>
//$(".ajax_news").colorbox({inline:true, width:"100%"});
</script>




