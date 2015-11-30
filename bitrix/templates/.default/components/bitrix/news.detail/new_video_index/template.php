<div class="main_block">
<div class="video_block">
<? if($arResult['PROPERTIES']['PHOTO_NO_VIDEO']['VALUE']): ?>

	<img id="new_header_stick_video" class="new_header_stick_video" style="height: 100%; position: relative; z-index: 0; width: 100%; tabindex="0" id="player_video" src="<?=$arResult['DETAIL_PICTURE']['SRC']; ?>" style="border:0;" />

<? else: ?>
<video id="new_header_stick_video" class="new_header_stick_video" style="height: 100%; position: relative; z-index: 0; width: 100%; tabindex="0" id="player_video" autoplay="autoplay" loop="loop"> 
        <? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']);?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' /><? endif; ?>            
                    	
    	<? if(isset($arResult['PROPERTIES']['VIDEO_OGV']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_OGV']['VALUE']);?>" type='video/ogg; codecs="theora, vorbis"' /><? endif; ?>	
    	
  		<? if(isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']);?>" type='video/webm; codecs="vp8, vorbis"' /><? endif; ?>
        
  			<h1><?=GetMessage("S_OLD_BROWSER")?></h1>
 	</video>
<? endif; ?>
</div>

<div class="beh_block">
    	<div class="logo"><a href="/">FromFoto.com</a></div>
        <div class="menu">
        	<? $APPLICATION->IncludeComponent("bitrix:menu", "simple_video_gallery_top", array(

	                            	"ROOT_MENU_TYPE" => "simple",

	                            	"MENU_CACHE_TYPE" => "A",

	                            	"MENU_CACHE_TIME" => "3600",

	                            	"MENU_CACHE_USE_GROUPS" => "N",

	                            	"MENU_CACHE_GET_VARS" => array(

	                            	),

	                            	"MAX_LEVEL" => "2",

	                            	"CHILD_MENU_TYPE" => "left",

                            		"USE_EXT" => "Y",

	                            	"DELAY" => "N",

	                            	"ALLOW_MULTI_SELECT" => "N"

	                            	),

	                            	false

                            	);?>
        </div>
        <div class="text_block">
        	<div class="change_text_all">
            <? $GLOBALS['filter_ex'] = array('ID' => $arResult['PROPERTIES']['TEXTS']['VALUE']); ?>
            <? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"index_texts",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "info",
		"IBLOCK_ID" => "17",
		"NEWS_COUNT" => "70",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "filter_ex",
		"FIELD_CODE" => "",
		"PROPERTY_CODE" => "",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d-m-Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "N"
	)
);?> 
            
            
        	
            
            </div>
            <div class="change_text" >
            	<?
                	$res = CIBlockElement::GetByID('1893');
					if($ar_res = $res->GetNext())
  					echo $ar_res['PREVIEW_TEXT'];
				?>
			</div>
        	<div class="btn_order"><br /><a class="order_clip " style="text-decoration:none;" href="/clips/">
            	<img style="border:none; width:239px;" class="try_free" src="<?=SITE_TEMPLATE_PATH?>/img/try_free.png" />
                <img style="border:none; width:239px;" class="try_free_popup" src="<?=SITE_TEMPLATE_PATH?>/img/try_free_popup.png" />
             </a></div>
            <div class="btn_order"><br /><br />
            <? if(!$arResult['PROPERTIES']['PHOTO_NO_VIDEO']['VALUE']): ?>
            <a class="value_on" style="text-decoration:none;" href="#"><img style="border:none;" src="<?=SITE_TEMPLATE_PATH?>/img/sound_on.png" /></a>
            <a class="value_off" style="text-decoration:none; display:none;" href="#"><img style="border:none;" src="<?=SITE_TEMPLATE_PATH?>/img/sound_off.png" /></a>
            <? endif; ?>
            </div>
        </div>
    </div>
 </div> 
 
 <style>
 	a.order_clip:hover .try_free_popup{
    	display:inline;
    }
 	a.order_clip:hover .try_free, .try_free_popup{
    	display:none;
    }
	.change_text{
		width:100%;
	}
	.beh_block{
		background:<? if(isset($arResult['DISPLAY_PROPERTIES']['BGR']['FILE_VALUE']['SRC'])):?>url('<?=$arResult['DISPLAY_PROPERTIES']['BGR']['FILE_VALUE']['SRC'];?>') repeat;<? else: ?> url('<?=SITE_TEMPLATE_PATH?>/img/new_bgr.png') repeat scroll 0 0 rgba(255, 255, 255, 0.66);<? endif; ?>
		height: 100%;
   		left: 0;
    	position: absolute;
   		top: 0;
    	width: 100%;
    	z-index: 999;
	}
	
	.text_block{
		margin: 0 12%;
   		position: absolute;
    	text-align: center;
   		top: 36%;
    	width: 76%;
	}
	
	.beh_block .logo{
		position:relative;
		left:50%;
		margin-left:-600px;
		top:3%;
		width:100px;
		height:8px;
	}
	
	.beh_block .menu{
		left: 50%;
    	position: relative;
    	text-align: right;
   		top: 3%;
    	width: 600px;
	}
	
	.beh_block .menu a{
		font-size: 22px;
   		padding-right: 10px;
	}
	
	.beh_block .logo a{
		text-decoration:none;
		font-size: 30px;
    	font-weight: bold;
	}
	
	.beh_block a{
		color:#040404;
	}
	
	.beh_block a:hover{
		text-decoration:underline;
	}
	
	.main_block{
		width:100%;
		height:100%;
		background:#414141;
		overflow:hidden;
	}
	
	@media (max-width: 1280px){
		.new_header_stick_video{
			height:720px !important;
			width:1280px !important;
			margin-left: -640px !important;
			left:50%;
			top:0px;
		}
		.beh_block .logo{
			margin-left:-500px;
		}
		.beh_block .menu{
			left: 40%;
		}
        .text_block .big{
			font-size:50px !important;
		}
		
		.text_block .small{
			font-size:20px !important;
		}
	}
	
	
	@media (max-width: 1024px){
		.new_header_stick_video{
			height:576px !important;
			width:1024px !important;
			margin-left: -512px !important;
			left:50%;
			top:0px;
		}
		
		.text_block{
   			top: 20%;
		}
		
		.text_block .big{
			font-size:50px !important;
		}
		
		.text_block .small{
			font-size:20px !important;
		}
		
		.beh_block .logo{
			margin-left:-400px;
		}
		
		.beh_block .menu{
			left: 30%;
		}
	}
	@media (max-width: 780px){
		.beh_block .logo{
			margin-left:-280px;
		}
		.beh_block .menu{
			left: 0px;
			top: 10%;
		}
	}
	
	@media (max-width: 580px){
		.text_block .big{
			font-size:40px !important;
		}
		
		.text_block .small{
			font-size:15px !important;
		}
		.text_block{
   			top: 20%;
		}
		.beh_block .logo{
			margin-left:-200px;
		}
		.beh_block .menu{
			display:none;
		}
	}
	
	@media (max-width: 400px){
		.beh_block .logo{
			margin-left:-50px;
		}
	}
	
</style>


<script>
	<? if(!$arResult['PROPERTIES']['PHOTO_NO_VIDEO']['VALUE']): ?>
	var video = document.getElementById("new_header_stick_video");
	$('.value_on').click(function(e){
		e.preventDefault();
		$('.value_on').hide();
		$('.value_off').show();
		video.volume = 0;
	});
	$('.value_off').click(function(e){
		e.preventDefault();
		$('.value_off').hide();
		$('.value_on').show();
		video.volume = 1;
	});
	
	
	<? endif; ?>
	
	$('.order_clip').click(function(){
		<? if(!$arResult['PROPERTIES']['PHOTO_NO_VIDEO']['VALUE']): ?>video.pause();<? endif; ?>
		$('.text_block').hide();
	});
	
	$('.first_back_close_popup').click(function(){
		$('.text_block').show();
		<? if(!$arResult['PROPERTIES']['PHOTO_NO_VIDEO']['VALUE']): ?>video.play();<? endif; ?>
	});
	
	
	count = 2
	num = 1;
	//show_hide_text_timer = setTimeout(show_hide_text, 3000);
	function show_hide_text(){
		num++;
		$('.change_text').hide();
		$('.ch_t_'+num).show();
		if(num == count){
			num = 0;
		}
		show_hide_text_timer = setTimeout(show_hide_text, 3000);
	}
	$('.change_text_all, .change_text_all div').not('.change_text').innerFade({speed:'slow',timeout:6000, children:'.change_text',animationType:'slideOver'});
	
	
</script>

 
 
