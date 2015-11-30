<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if($arResult["ITEMS"]): ?>

<? 

CModule::IncludeModule("iblock");
$sections_ci = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID" => '30', 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>'1'));
$first_section = $sections_ci->GetNext();
$first_section['ID'] = ($_REQUEST['section'])? $_REQUEST['section']:$first_section['ID'];
if($arParams["BEST_PAGE"] && $arParams["BEST_PAGE"] == 'Y'){
	$sections_ci = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID" => '30', 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>'1', 'UF_BEST'=>'1'));
	if($best_section = $sections_ci->GetNext()){
		$first_section = $best_section;
	}
}

$clip_folder = ($arParams["BEST_PAGE"]) ? 'create_video/best' : 'create_video';

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

function Get_currency($currency){

	switch ($currency) {
	    case "3":
	        return "рублей";
	        break;
	    case "4":
	        return "$";
	        break;
	    case "17":
	        return "EUR";
	        break;
	}	
}

?>

<div class="works-items row">

	<? foreach($arResult["ITEMS"] as $arItem):?>

    	<?

			$renderImage = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
			
			$groups_r = CIBlockElement::GetElementGroups($arItem['ID'], true);
			$groups_id = array();
			while($ar_group = $groups_r->Fetch()){
    			$groups_id[] = $ar_group["ID"];
			}
			$add_class = '';
			if($groups_id){
				$add_class = 'templ_'.implode(' templ_',$groups_id);
			}
		?>
        
        

    	<div <? if($arItem['IBLOCK_SECTION_ID'] != $first_section['ID']):?>style="opacity:0; display:none;"<? endif;?> class="work-item col-sm-4 <?=$add_class;?> templ_<?=$arItem['IBLOCK_SECTION_ID'];?> templ_<?=$prnt_section[$arItem['IBLOCK_SECTION_ID']];?>">

			<? if($arItem['PROPERTIES']['PREV_VIMEO']['VALUE']):?>
				<div style="width: 100%;">
                <?echo(str_replace(array("autoplay=1", 'width="500"', 'height="281"'), array("autoplay=0", 'width="100%"', 'height="auto"'), $arItem['PROPERTIES']['PREV_VIMEO']['~VALUE']));?>
                </div>
			<? else: ?>
	            <a href="<?=SITE_DIR?><?=$clip_folder; ?>/?video_id=<?=$arItem['ID'];?>" class="work-target popup_video_creation"> 
	
	                <img src="<?=$renderImage['src']; ?>" alt="<?=$arItem['NAME'];?>" class="img-responsive">
	
	            </a>
			<? endif; ?>
			<div class="information">
            	<a href="<?=SITE_DIR?><?=$clip_folder; ?>/?video_id=<?=$arItem['ID'];?>"><div class="name_info"><?=$arItem['NAME'];?></div></a>
                <? if($arItem['PREVIEW_TEXT']): ?><div class="description"><?=$arItem['PREVIEW_TEXT'];?></div><? endif; ?>
                <? if($arItem['PROPERTIES']['INFO_ABOUT']['VALUE']): ?><div class="info_about"><?=$arItem['PROPERTIES']['INFO_ABOUT']['VALUE'];?></div><? endif; ?>
                <div class="choose_this">
            		<div class="left_part">
                		<a href="<?=SITE_DIR?><?=$clip_folder; ?>/?video_id=<?=$arItem['ID'];?>" class="btn_go choose_tmp">выбрать шаблон</a>
                	</div>
                	<div <? if($arParams["BEST_PAGE"]):?>style="font-size:16px;"<? endif; ?> class="right_part">
                		<? if($arItem['PROPERTIES']['COST']['VALUE']): ?><?=$arItem['PROPERTIES']['COST']['VALUE']; ?> <?=Get_currency($arItem['PROPERTIES']['CURRENCY']['VALUE_ENUM_ID'])?><? if(!$arParams["BEST_PAGE"]):?><br />без предоплаты<? endif; ?><? else: ?>БЕСПЛАТНО<? endif; ?>
                	</div>
                	<div class="clear"></div>
            	</div>
            </div>
            
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