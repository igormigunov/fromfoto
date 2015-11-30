<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if($arResult["ITEMS"]): ?>

<? 

CModule::IncludeModule("iblock");
$sections_ci = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID" => '30', 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>'1'));
$first_section = $sections_ci->GetNext();

$first_section['ID'] = ($_REQUEST['section'])? $_REQUEST['section']:$first_section['ID'];

$sections = array();

$prnt_section = array();

$iblock_id = (SITE_ID == 'en')?'34':'30';

foreach($arResult["ITEMS"] as $arItem){

	if(!in_array($arItem['IBLOCK_SECTION_ID'],$sections)){

		$sections[] = $arItem['IBLOCK_SECTION_ID'];

		$rsPath = GetIBlockSectionPath($iblock_id, $arItem['IBLOCK_SECTION_ID']);

		$arPath = $rsPath->GetNext();

		$prnt_section[$arItem['IBLOCK_SECTION_ID']] = $arPath['ID'];

	}

}



?>



<?

$newWidth = 600;

$newHeight = 400;

$first_items = array();
foreach($arResult["ITEMS"] as $k=>$v){
	if($v['IBLOCK_SECTION_ID'] == $first_section['ID']){
		$first_items[] = $v;
		unset($arResult["ITEMS"][$k]);
	}
}
$arResult["ITEMS"] = array_merge($first_items, $arResult["ITEMS"]);


?>

<div class="works-items row">

	<? foreach($arResult["ITEMS"] as $arItem):?>

    	<?

			$renderImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);

		?>

    	<div <? if($arItem['IBLOCK_SECTION_ID'] != $first_section['ID']):?>style="opacity:0; display:none;"<? endif;?> class="work-item col-sm-4 templ_<?=$arItem['IBLOCK_SECTION_ID'];?> templ_<?=$prnt_section[$arItem['IBLOCK_SECTION_ID']];?>">

            <a class="work-target popup_video_creation"> 

                <span class="work-detail-wrapper">

                    <span class="work-detail">

                        <span class="work-detail-icon">

                            <i class="fa fa-picture-o" data-animation="shake"></i>

                        </span><!-- /.work-detail-icon -->



                        <span class="work-detail-title">

                            <?=$arItem['NAME'];?>                                                    

                        </span><!-- /.work-detail-title -->



                        <span class="work-detail-button">
							<? if($arItem['PROPERTIES']['PREV_VIMEO']['VALUE']):?>
                            <span title="<?=$arItem['NAME'];?>" href="/ajax/show_vimeo.php?video_id=<?=$arItem['ID'];?>" class="btn preview_video_btn preview_video_btn_<?=$arItem['ID'];?>"><?=GetMessage("S_PREVIEW")?></span>&nbsp;
                            <? else:?>
                            <span title="<?=$arItem['NAME'];?>" href="/ajax/show_preview.php?video_id=<?=$arItem['ID'];?>" class="btn preview_video_btn preview_video_btn_<?=$arItem['ID'];?>"><?=GetMessage("S_PREVIEW")?></span>&nbsp;
                            <? endif; ?>
                            
                            
                            
                            <? if($arItem['PROPERTIES']['WE_DO']['VALUE']):?>
                            	<span href="<?=SITE_DIR?>create_simple_video/?video_id=<?=$arItem['ID'];?>" class="btn choose_redactor_type"><?=GetMessage("S_VIEW_CLIP")?></span>
                            	<? /*<span title="<?=$arItem['NAME'];?>" href="/ajax/select_redactor.php?video_id=<?=$arItem['ID'];?>" class="btn choose_in_redactor_type"><?=GetMessage("S_VIEW_CLIP")?></span>*/?>
                            <? else: ?>
                            	<span href="<?=SITE_DIR?>create_video/?video_id=<?=$arItem['ID'];?>" class="btn choose_redactor_type"><?=GetMessage("S_VIEW_CLIP")?></span>
                            <? endif; ?>
                            
                            <? /* if(!$arItem['PROPERTIES']['FREE_PERIOD']['VALUE']):?>
                            <span href="<?=SITE_DIR?>create_video/?video_id=<?=$arItem['ID'];?>" class="btn choose_redactor_type"><?=GetMessage("S_VIEW_CLIP")?></span>
                            <? else: ?>
                            <span href="<?=SITE_DIR?>create_video/?video_id=<?=$arItem['ID'];?>" class="btn choose_redactor_type"><?=GetMessage("S_VIEW_CLIP")?></span>
                            
                            <? endif; */?>

                        </span><!-- /.work-detail-button -->

                    </span><!-- /.work-detail -->

                </span><!-- /.work-detail-wrapper -->



                <img src="<?=$renderImage['src']; ?>" alt="<?=$arItem['NAME'];?>" class="img-responsive">

            </a>

        </div>

    <script>
	
	<? if($arItem['PROPERTIES']['PREV_VIMEO']['VALUE']):?>
	$(".preview_video_btn_<?=$arItem['ID'];?>").colorbox({
		iframe:true, 
		width:"545px", 
		height:"361px"
	});
	<? else: ?>
		$(".preview_video_btn_<?=$arItem['ID'];?>").colorbox({
			iframe:true, 
			width:"772px", 
			height:"558px"
		});
	<? endif; ?>
	
	</script>

    <? endforeach; ?>

</div>



<script>
	$('.works-filter.clips a').click(function(){
		$('.work-item').show();
	})
	
	$(".choose_in_redactor_type").colorbox({
		iframe:false, 
		width:"400px", 
		height:"300px"
	});

	/*$(".preview_video_btn").colorbox({
		iframe:true, 
		width:"772px", 
		height:"558px",
		title:false,
		closeButton:false, 
		onOpen:function(){ $('#cboxBottomLeft, #cboxBottomCenter, #cboxBottomRight').addClass('hide_bottom_cbox');},
		onClosed:function(){ $('#cboxBottomLeft, #cboxBottomCenter, #cboxBottomRight').removeClass('hide_bottom_cbox');}
	});*/
	
	

</script>

<? endif; ?>