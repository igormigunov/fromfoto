<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$newWidth = 700;
$newHeight = 578;
$renderImage = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
?>	

<div id="menu-instruction" class="block-content about-wrapper block-padding-large" style="padding-top: 65px; background:url('<?=$renderImage['src'];?>');background-position: right bottom;background-repeat: no-repeat;background-size: 60% auto;">
                        <div class="about">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class="block-title"><?=$arResult['NAME'];?></h2>

                                    <p class="slogan about-slogan">
                                        <?=$arResult['PREVIEW_TEXT'];?>
                                    </p>

                                    <a style="background:none;" class="btn btn-fancy popup_instruction" title="<?=$arResult['NAME']?>" href="<?=SITE_DIR?>ajax/video.php?video_id=<?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['ID'];?>">
                                        <span style="color:white;"><?=GetMessage("S_WATCH_VIDEO")?></span>
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
                        
                        <div id="video_show_room">
                        	<?=$arResult['DISPLAY_PROPERTIES']['youtube']['~VALUE'];?>
                        
                        	<? /*
$lng = (SITE_ID == 'en')?'en_':'';
         $APPLICATION->IncludeComponent("bitrix:player", ".default", array(

	"PATH" => "/".$lng."instruction.mp4",//CFile::GetPath($arResult['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['ID']),

	"PROVIDER" => "",

	"WIDTH" => "327",

	"HEIGHT" => "216",

	"AUTOSTART" => "N",

	"REPEAT" => "none",

	"VOLUME" => "90",

	"ADVANCED_MODE_SETTINGS" => "N",

	"PLAYER_TYPE" => "auto",

	"USE_PLAYLIST" => "N",

	"STREAMER" => "",

	"PREVIEW" => "",

	"FILE_TITLE" => "",

	"FILE_DURATION" => "",

	"FILE_AUTHOR" => "",

	"FILE_DATE" => "",

	"FILE_DESCRIPTION" => "",

	"PLAYER_ID" => "",

	"BUFFER_LENGTH" => "10",

	"DOWNLOAD_LINK" => "",

	"DOWNLOAD_LINK_TARGET" => "_self",

	"ADDITIONAL_WMVVARS" => "",

	"ALLOW_SWF" => "N",

	"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",

	"SKIN" => "",

	"CONTROLBAR" => "bottom",

	"WMODE" => "transparent",

	"LOGO" => "",

	"LOGO_LINK" => "",

	"LOGO_POSITION" => "none",

	"PLUGINS" => array(

		0 => "",

		1 => "",

	),

	"ADDITIONAL_FLASHVARS" => "",

	"WMODE_WMV" => "window",

	"SHOW_CONTROLS" => "Y",

	"SHOW_DIGITS" => "Y",

	"CONTROLS_BGCOLOR" => "FFFFFF",

	"CONTROLS_COLOR" => "000000",

	"CONTROLS_OVER_COLOR" => "000000",

	"SCREEN_COLOR" => "000000",

	"MUTE" => "N"

	),

	false

);*/?> 
                        
                        	<!--<iframe src="<?=SITE_DIR?>ajax/video.php?video_id=<?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['ID'];?>&width=326&height=216" style="border:none" width="800px" height="600px"></iframe>-->
                        </div>
                    </div>
                    
                    
<script>
$(".popup_instruction").colorbox({iframe:true,width:"830", height:"620"});
</script>

<style>
	#video_show_room{
		left: 649px;
    	margin-top: -323px;
    	position: absolute;
	}
</style>