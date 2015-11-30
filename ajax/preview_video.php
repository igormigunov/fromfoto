<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$APPLICATION->ShowHead();?>
<? if($_REQUEST['file_name']): ?>

<? preg_match("/\.mp4$|\.flv$|\.avi$|\.mov$/i",$_REQUEST['file_name'], $ext);?>

<? if(in_array($ext[0],array('.mp4','.flv'))): ?>
<div style="width:100%; height:100%; text-align:center;">
		<? 

         $APPLICATION->IncludeComponent("bitrix:player", ".default", array(

	"PATH" => "/upload/tmp/".$_COOKIE['UPLOAD_FILES']."/".$_REQUEST['file_name'],

	"PROVIDER" => "",

	"WIDTH" => "522",

	"HEIGHT" => "294",

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

);?> 


        </div>
<? elseif(in_array($ext[0],array('.mov','.avi'))):?>  
<div style="width:100%; height:100%; text-align:center;">
	<img src="/upload/video_pleer.png" style="border:none; width:522px; height:294px;" />
</div>
    
<? endif;?>
<style>
	body{
		margin:0px;
	}
</style>
<? endif; ?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>