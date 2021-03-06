<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="chel_login">
    <div class="lg">
        <span>Шаблон</span>
    	<?=$arResult['NAME'];?>
    </div>
    <div class="rg"></div>
</div>
<style>
.middle-block {
    border: none;
}
</style>
<?
function clear_dir($dir)
{
    $list = myscandir($dir);
    foreach ($list as $file)
    {
        if (is_dir($dir.$file))
        {
            clear_dir($dir.$file.'/');
            rmdir($dir.$file);
        }
        else
        {
            unlink($dir.$file);
        }
    }
}
function myscandir($dir)
{
    $list = scandir($dir);
    unset($list[0],$list[1]);
    return array_values($list);
}
$_SESSION["HASH_CODE"] = md5(rand(9999999,9999));
//выбор фотографий для данного клипа
$arFilter = Array(
   "IBLOCK_ID"=>"31", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($arResult['PROPERTIES']['PHOTO']['VALUE'])? $arResult['PROPERTIES']['PHOTO']['VALUE']:-1
   );
$arSelect = array("PROPERTY_SIZE","PROPERTY_SECOND","PROPERTY_NO_VIDEO","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$photo = array();
while($ar_fields = $res->GetNext())
{
  $photo[] = $ar_fields;
}

//выбор текстов для данного клипа
$arFilter = Array(
   "IBLOCK_ID"=>"32", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($arResult['PROPERTIES']['TEXTS']['VALUE'])? $arResult['PROPERTIES']['TEXTS']['VALUE']:-1
   );
$arSelect = array("PROPERTY_COUNT_SYMBOLS","PROPERTY_SECOND","PROPERTY_SIGN","ID","NAME","PROPERTY_TIME_CLIP","PREVIEW_PICTURE");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$texts = array();
while($ar_fields = $res->GetNext())
{
  $texts[] = $ar_fields;
}

$show_step = 1;


//пояснение для первого обрезания.
$arFilter = Array(
   "IBLOCK_ID"=>"17", 
   "ACTIVE"=>"Y", 
   "ID"=>"1564"
   );
$arSelect = array("NAME","PREVIEW_PICTURE","PREVIEW_TEXT","ID");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$text_explain = $res->GetNext();


//пояснение после заказа.
$arFilter = Array(
   "IBLOCK_ID"=>"17", 
   "ACTIVE"=>"Y", 
   "ID"=>"1621"
   );
$arSelect = array("NAME","PREVIEW_PICTURE","PREVIEW_TEXT","ID");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$text_after_order = $res->GetNext();

  
	//настройки для логотипа.
$arFilter = Array(
   "IBLOCK_ID"=>"17", 
   "ACTIVE"=>"Y", 
   "ID"=>"1586"
   );
$arSelect = array("NAME","PREVIEW_TEXT","ID","PROPERTY_LOGO_COST","PROPERTY_LOGO_SIZE");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$logo_sett = $res->GetNext();

$arSelect = Array(
	"ID", 
	"IBLOCK_ID",
	"PREVIEW_TEXT",		
	"NAME", 
	"DATE_CREATE", 
	"PROPERTY_USER_EMAIL", 
	"PROPERTY_USER_NAME", 
	"PROPERTY_PAID", 
	"PROPERTY_TELL_FRIENDS", 
	"PROPERTY_ALREADY_SEND",
	"TELL_FRIENDS", 
	"PROPERTY_FILE_LINK",
	"PROPERTY_YOUTUBE",
	"PROPERTY_USER",
	"PROPERTY_PREVIEW_VIDEO",
);
$clip_id = preg_replace("/^\d{3}/", "", intval($_REQUEST['clip']));
$clip_id = preg_replace("/\d{1}$/", "", intval($clip_id));
$arFilter = array(
	"IBLOCK_ID" => 33,
	"ID" => $clip_id
);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$el = new CIBlockElement;
if(!($clip = $res->GetNext())){
	LocalRedirect("/create_video/?video_id=".$_REQUEST['video_id']);
}

$rsUser = CUser::GetByID($clip['PROPERTY_USER_VALUE']);
$arUser = $rsUser->Fetch();

$tmp = $_COOKIE['UPLOAD_FILES']."/resizes/";
clear_dir($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'r/');
$path_to_dir = '/upload/tmp/'.$tmp.'r/'.time().'/';
$uploaddir = $_SERVER['DOCUMENT_ROOT'].$path_to_dir;
$dir = '/home/admin/zakaz/'.$clip_id.'_33/';
if (!file_exists($dir)) {
	LocalRedirect("/create_video/?video_id=".$_REQUEST['video_id']);
}
if (!file_exists($uploaddir)) {
	mkdir($uploaddir, 0755, true);
}
?>


<? if($USER->IsAuthorized() && isset($_SESSION['user_clip_data'])): ?>
<script>
	$.post("<?=SITE_DIR?>ajax/create_clip.php",{},function(data){
		var free_period = '<?=$_SESSION['user_clip_data']['free_period']; ?>';
		var now = new Date();
  		var expire = new Date();
  		expire.setFullYear(now.getFullYear());
  		expire.setMonth(now.getMonth());
  		expire.setDate(now.getDate()+1);
  		expire.setHours(0);
  		expire.setMinutes(0);
			
		if(free_period){
			setcookie("FREE_LIMIT",1,expire,'/');
		}else{
			if(getCookie('PAID_LIMIT')){
				setcookie("PAID_LIMIT",parseInt(getCookie('PAID_LIMIT'))+1,expire,'/');1
			}else{
				setcookie("PAID_LIMIT",1,expire,'/');
			}
		}
		$.post("<?=SITE_DIR?>ajax/create_clip2.php",{},function(data){
			window.location = '/';
		});
	});
</script>

<div class="container">
    <p style="font-size:25px; text-align:center; color:#000; font-weight:normal;"><?=GetMessage("S_YOUR_DATA")?></p>
</div>

<? else: ?>
<div id="preview_popup_full" class="no_hide_after_order">
</div>
<div id="preview_popup" class="no_hide_after_order">
<div id="text_explain" class="preview_popup no_hide_after_order" style="background-image:url('<?=CFile::GetPath($text_explain['PREVIEW_PICTURE']);?>'); display:none;" >
	<div class="text_popup no_hide_after_order">
		<?=$text_explain['PREVIEW_TEXT']; ?>
	</div>
	<div class="btn_work no_hide_after_order">
		<div class="centr_btn no_hide_after_order">
			<a class="close_prev_popup" style="margin-left:0px; display:inline-block; float:none;" href="#"><?=GetMessage("S_I_KNOW")?></a>
		</div>			
	</div>
</div>

<div id="text_after_order" class="preview_popup" style="background-image:url('<?=CFile::GetPath($text_after_order['PREVIEW_PICTURE']);?>'); display:none;" >
	<div class="text_popup">
		<?=$text_after_order['PREVIEW_TEXT']; ?>
	</div>
	<div class="btn_work">
		<div class="centr_btn">
			<a class="close_prev_popup" style="margin-left:0px; display:inline-block; float:none;" href="#"><?=GetMessage("S_NOW_CHECK")?></a>
		</div>			
	</div>
</div>

<? global $USER; ?>
<? if(!$USER->IsAuthorized()):?>
<div id="auth_social" class="preview_popup" style="background-image:none; background:#fff; border: 2px solid #6da0e1;" >
	<div class="text_popup">
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","fromfoto",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
);?>
	</div>
</div>
<script>

$(document).ready(function(e) {
	
	//$('#preview_popup_full, #preview_popup').show();
	//check_popup++;
});
</script>
<? /*<style>

	#preview_popup{
		width: 740px !important;
		margin-left: -370px !important;
		height: 340px !important;
		margin-top: -170px !important;
	}
	
	.preview_popup .text_popup{
		width: 740px !important;
		height: 340px !important;
	}
</style> */?>
<? endif; ?>


</div>
<?
if($_REQUEST['show']){
	print_r($arResult);
}
?>
<? if($clip['PROPERTY_PREVIEW_VIDEO_VALUE']):?>
<?
if (file_exists($dir)) {
	$filename = $dir."check_list.txt";
	$handle = fopen($filename, "r");
	$contents_img = fread($handle, filesize($filename));
	$contents_img = ( explode("\r\n", $contents_img ) );
	fclose($handle);
	copy($dir.$contents_img[0], $uploaddir.$contents_img[0]);
	//echo $uploaddir.$contents_img[0];
}
?>
<div class="video" style="width: <? if(is_mobile()): ?>260px;<? else: ?>520px;<? endif; ?>; margin: auto;">
<? 
$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
	"PATH" => $clip['PROPERTY_PREVIEW_VIDEO_VALUE'],
	"PROVIDER" => "",
	"WIDTH" => is_mobile()? "260" : "520",
	"HEIGHT" => is_mobile()? "160" : "320",
	"AUTOSTART" => "N",
	"REPEAT" => "none",
	"VOLUME" => "90",
	"ADVANCED_MODE_SETTINGS" => "N",
	"PLAYER_TYPE" => "auto",
	"USE_PLAYLIST" => "N",
	"STREAMER" => "",
	"PREVIEW" => (file_exists($uploaddir.$contents_img[0])) ? $path_to_dir.trim($contents_img[0]) : '',
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
<? endif;?>
<? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])):?>
	<div style="display:none" class="">
    <video tabindex="0" id="player_video"> 	
    	<? if(isset($arResult['PROPERTIES']['VIDEO_OGV']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_OGV']['VALUE']);?>" type='video/ogg; codecs="theora, vorbis"' /><? endif; ?>	
    	<? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']);?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' /><? endif; ?>
  		<? if(isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']);?>" type='video/webm; codecs="vp8, vorbis"' /><? endif; ?>
        
  		<h1><?=GetMessage("S_OLD_BROWSER")?></h1>
 	</video>
    
    <div id="video_controls">
        	<div class="play_pause">
            	<a class="start" title="<?=GetMessage("S_START_VIDEO")?>">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/play_v.png" />
				</a>
        		<a class="pause" style="display:none;" title="<?=GetMessage("S_PAUSE")?>">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/pause_v.png" />
                </a>
            </div>
            <div class="progress_sin">
            	<div class="progress_v">
  					<div class="total">
        				<div class="buffered">
                        	<div class="current"><? /*<img style="height:30px; width:8px; margin-top:-9px;" src="<?=SITE_TEMPLATE_PATH?>/img/plz.png" /> */?>​</div>
                        </div>
    				</div>
				</div>
            </div>
            <div class="volume_sin">
            	<a class="volume_on">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/volume_on_v.png" />
				</a>
        		<a class="volume_off" style="display:none;">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/volume_off_v.png" />
                </a>
            </div>
            <div class="progress_volume">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/volume_plz_v.png" />
            </div>
            <div class="full_screen">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/full_screen.png" />
            </div>
    </div>
    
    </div>
    <? endif; ?>

<div class="container hide_after_order">
    	<?
        	$_plural_images = array(GetMessage("S_IMAGE"), GetMessage("S_IMAGES"), GetMessage("S_IMAGES1"));
			$count_pictures = "<span class='blue'> ЕЩЁ ".sizeof($photo)." ФОТО </span> ";//.$_plural_images[plural_type(sizeof($photo))];
		
		?>
		<h3 class="container_h3"><span class="step_num"><?=sprintf(GetMessage("S_STEP"),$show_step);?></span>
        <? $show_step++; ?>
        <span id="count_pictures_container"><? printf(GetMessage("S_ALL_PHOTO_COMPLETE"),$count_pictures);?></span><span style="display: none;" id="all_pictures_container"><? printf(GetMessage("S_ALL_PHOTO_COMPLETE"),$count_pictures);?></span></h3>
        <div class="imgs_uploader">
            <!-- The file upload form used as target for the file upload widget -->
            <form id="fileupload" action="/ajax/upload.php" method="POST" enctype="multipart/form-data">
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <div class="fileupload-buttonbar">
                    <div class="my-container">
                    	<!--<img src="/images/add_photo.png" class="add_photo_img" />-->
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-2"></div>
                        </div>
                        <!-- The global file processing state -->
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="col-lg-5 fileupload-progress fade" style="display: none;">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-info" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
                <!-- The table listing the files available for upload/download -->
                <table role="presentation" class="table table-striped"><tbody class="files">
					<? $num = 0; ?>
					<?
					$filename = $dir."check_list.txt";
					$handle = fopen($filename, "r");
					$contents_img = fread($handle, filesize($filename));
					$contents_img = ( explode("\r\n", $contents_img ) );
					fclose($handle);

					?>
					<? foreach($photo as $ph): ?>
						<? $num++; ?>
						<? $photo_n = ($num-1);?>
						<?
							$contents_img[$photo_n] = trim($contents_img[$photo_n]); 
							copy($dir.$num.'_.jpg', $uploaddir.$num.'_.jpg');
							copy($dir.$contents_img[$photo_n], $uploaddir.$contents_img[$photo_n]);
							list($w_i, $h_i, $type) = getimagesize($dir.$contents_img[$photo_n]);
						?>
						<div class="img_prev_upl in" style="opacity: 1 !important;">
							<span class="preview">            	
								<span class="num">№ <?=$num; ?> </span><br>
								
								<img class='shprew' src="<?=$path_to_dir.$num.'_.jpg';?>" uniq_name="<?=$num.'_.jpg';?>" file_name="<?=$num.'_.jpg';?>" real_height="<?=$h_i ? $h_i : "720"?>" real_width="<?=$w_i ? $w_i : "1280"?>" id="img_n-<?=$photo_n; ?>" href="<?=$path_to_dir.trim($contents_img[$photo_n]);?>">
								<img style="border: medium none; width: 40px; height: 40px; margin-left: -43px; position: relative; margin-top: 20px; display: none;" src="/images/check.png" class="check">
							</span>
						</div>
					<? endforeach;?>
				</tbody></table>
            </form>

        
        </div>
    </div>


<div class="popup_video_work_station">
	<div class="comm_image"><img src="/images/com_img.png" />
	</div>
	<div style="" class="video_work_station hide_after_order">
    	<div class="img_area">
        	<div class="img_block">
    			<div style="display:none;" class="show_text"></div>
       			<div style="display:none;" class="min_size"><?=GetMessage("S_MINIMUM_SIZE")?></div>
        		<div class="clip_imgs"></div>
			</div>
        </div>
        <div class="next_prev_img" style="padding-left: 125px; display:none;">
        	<div class="prev_img">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/left_str.png" style="border:none;" />
            </div>
            <div class="text_scrl" style="width:260px;">
            	<h3 class="container_h3" style="text-align:center; margin:0px;padding-top: 7px;"><?=GetMessage("S_ALIGN_PHOTO")?> <span class="blue num_align_photo"></span></h3>
            </div>
            <div class="video_scrl" style="display:none;width:260px;">
            	<h3 class="container_h3" style="text-align:center; margin:0px;padding-top: 7px;"><?=GetMessage("S_YOUR_VIDEO")?></h3>
            </div>
            <div class="next_img">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/right_str.png" style="border:none;" />
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="btns">
    	<a class="btn_go save_and_go" href="#"><?=GetMessage("S_SAVE_AND_GO");?></a>
        <!--<a class="btn_go delete_this_photo" href="#"><?=GetMessage("S_DELETE_THIS_PHOTO");?></a>-->
    </div>
</div>
<div class="clear hide_after_order"></div>
    <div class="error_vertical hide_after_order hide_from_redo" style="text-align:center; font-size:28px; color:#F00; display:none;">
    	<div class="error_text" style="text-align:center; padding-top: 20px;"></div>
        <div style="text-align:center;padding-top: 15px;"><input type="button" class="btn btn-primary silver_btn" href="#text_before_submit_free" id="show_how_clip_btn" value="<?=GetMessage("S_HOW_TO")?>"></div>
    </div>
    <div class="clear hide_after_order hide_from_redo" style="padding-bottom:30px !important;"></div>
    <div class="error_size hide_after_order " style="text-align:center; font-size:28px; color:#F00;"></div>
    
    <div class="container step_2_station hide_after_order hide_from_redo">
    	<div class="player">
    	<div id="time_time" style="display:none">0</div>
		<div style="text-align:center; width:660px; margin:auto;"><h3 class="container_h3 step_2_station"><span class="step_num"><?=sprintf(GetMessage("S_STEP"),$show_step);?></span><?=GetMessage("S_CONTROL_BUTTONS")?></h3></div>
        <? //$show_step++; ?>
        <div class="synchronization" style="">
        	<div class="play_pause">
            	<a class="start" title="<?=GetMessage("S_START_VIDEO")?>">

				</a>
        		<a class="pause" style="display:none;" title="<?=GetMessage("S_PAUSE")?>">

                </a>
            </div>
            
            <div class="progress_sin">
            	<div class="progress_v">
  					<div class="total">
        				<div class="buffered">
                        	<div class="current"><? /*<img style="height:30px; width:8px; margin-top:-9px;" src="<?=SITE_TEMPLATE_PATH?>/img/plz.png" /> */?>​</div>
                        </div>
    				</div>
				</div>
				<span class="time" style="display:none;">
    				<span class="currenttime">00:00</span> / 
    				<span class="duration">00:00</span>
				</span>
            </div>
            
            <div class="time_sinc">
            	<span class="time">
    				<span class="currenttime">00:00</span> / 
    				<span class="duration">00:00</span>
				</span>
            </div>
            
            
            <div class="volume-container">
            	<div class="volume">
                	<div volume='20' class=""></div>
                    <div volume='40' class=""></div>
                    <div volume='60' class=""></div>
                    <div volume='80' class=""></div>
                    <div volume='100' class=""></div>
                </div>
            </div>
            
            <? /*<div class="volume_sin">
            	<a class="volume_on">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/volume.png" />
				</a>
        		<a class="volume_off" style="display:none;">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/volume_off.png" />
                </a>
            </div>
            
            <div class="progress_volume">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/volume_plz.png" />
            </div> */?>
            
            <div class="full_screen">
            	<img class="full_screen_def" src="<?=SITE_TEMPLATE_PATH?>/img/full_screen.png" />
                <img class="full_screen_hover" src="<?=SITE_TEMPLATE_PATH?>/img/full_screen_hover.png" />
            </div>
		</div>
           
            
            
            
    		<? /*<a id="start" title="<?=GetMessage("S_START_VIDEO")?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/video_ico/play.png" /></a>
        	<a id="pause" style="display:none;" title="<?=GetMessage("S_PAUSE")?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/video_ico/pause.png" /></a>
        	<a id="in_start" title="<?=GetMessage("S_FIRST_START")?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/video_ico/repeat.png" /></a>
        	<a id="stop" title="<?=GetMessage("S_STOP")?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/video_ico/stop.png" /></a>*/ ?>
   		</div>
    </div>
    
    
    
    
    <?/* if($arResult['PROPERTIES']['WITH_LOGO']['VALUE']):?>
    <div class="clear hide_after_order" style="padding-bottom:50px !important;"></div>
    <div class="container step_2_station logo_biz hide_after_order">
    	<h3 class="container_h3"><span class="step_num"><?=sprintf(GetMessage("S_STEP"),$show_step);?></span><?=GetMessage("S_ADD_LOGO")?></h3>
        <? $show_step++; ?>
        <div style="margin:0 auto; width:868px;">
        	<div style="float:left; margin-right:39px">
        	<input type="button" value="<?=GetMessage("S_ADD")?>" id="add_logo" class="btn btn-primary silver_btn">
            </div>
            
            <div id="logo_viz" class="logo_viz_brdr" logo_width="<?=$arResult['PROPERTIES']['LOGO_SIZE']['VALUE']; ?>">
				<div class="logo_name"></div>
                <div class="logo_img_div"></div>
            </div>
        </div>
        
    </div>
    <div class="clear hide_after_order" style="padding-bottom:20px !important;"></div>
    <? endif;*/?>
    
    <div class="clear hide_after_order hide_from_redo" style="padding-bottom:50px !important;"></div>
    <div class="container step_2_station hide_after_order">
    <h3 class="container_h3"><span class="step_num"><?=sprintf(GetMessage("S_STEP"),$show_step);?></span><?=GetMessage("S_ADD_MP3")?></h3>
    <div class="col-lg-7 button-create">
		<!--<img src="/images/add_sound_img.png" class="add_photo_img">-->
		<i class="fa fa-volume-up fa-2x"></i><input id="add_mp3" type="button" value="<?=GetMessage("S_ADD_MUSIC")?>" class="btn btn-primary silver_btn">
	</div>
    	<div class="mp3_uploader">
        <? $show_step++; ?>
        <div class="row">     
            <?
			copy($dir.'audio.mp3', $uploaddir.'audio.mp3');
           	$file_path = $path_to_dir.'audio.mp3';
			$paths = explode("/",$file_path);
			$file_name = $paths[sizeof($paths)-1];
			?>
            
            <div id="mp3_viz" class="col-xs-7">
            	<div class="audio_name">
                    <div class="mp3_name"><?=$file_name; ?></div>
                </div>
                <div id="audio_player">
            		<audio id="audio_player_cl" src="<?=$file_path;?>" preload="auto"></audio>
                </div>
            
        	    <div path='<?=$file_path;?>' id="path_to_mp3"></div>
            
                <div path='<?=$file_path;?>' id="path_to_return_mp3" mp3_name="<?=$file_name; ?>"></div>
            </div>
            <div class="col-xs-4">
            <input type="button" value="<?=GetMessage("S_RETURN")?>" id="return_mp3" class="btn btn-primary silver_btn silver_btn_no_border">
            </div>
        </div>
     </div>  
     
     <div><?=GetMessage("S_IF_ADD_MUSIC")?></div> 
    </div>
    
    
    
    <? if($texts): ?>
   <? 
   		$newWidth = 193;
		$newHeight = 108;
	?>
    
    <div class="container step_2_station hide_after_order my-indent">
		<?
		if($_COOKIE['UPLOAD_FILES']){
			$tmp = $_COOKIE['UPLOAD_FILES']."/";
		}
		$arTexts = unserialize($APPLICATION->GetFileContent($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'texts.txt'));
	  	?>
        <? $num = 0; ?>
    	<? foreach($texts as $k=>$v): ?>
        <? $num++; ?>
        <div>
        	
        	<div class="container">
                <div class="row">
            <div <? if(!($v['PREVIEW_PICTURE'] || $v['PROPERTY_TIME_CLIP_VALUE'])): ?><? endif;?> class="col-xs-10 add_text">
            	<h3 class="container_h3" style="margin-top: 0;margin-bottom: 11px;">
                    <span class='blue'>
                        <?=GetMessage("S_TEXT_NUM")?> <?=$num;?> 
                    </span>
			<? if($v['PROPERTY_COUNT_SYMBOLS_VALUE']): ?>
            	( <?=GetMessage("S_RESTRICTION")?> <span class="blue count_text_value"><?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?></span> <?=GetMessage("S_CHARACTERS")?> )
			<? else: ?>
				<?//=GetMessage("S_NO_RESTRICTION")?>.
			<? endif; ?>
            </h3>
				<?
					$filename = $dir."text".$num.".txt";
					
					$handle = fopen($filename, "r");
					$content = trim(fread($handle, filesize($filename)));
					$content = preg_replace("/\\r\\n/", "", $content);
					fclose($handle);
				?>
            	<textarea <? if($v['PROPERTY_SIGN_VALUE']):?> placeholder="<?=$v['PROPERTY_SIGN_VALUE']; ?>"<? endif; ?> class="text_inp text_show_<?=$k;?>" size_value="<?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?>" ><?=$content;?></textarea>
                </div>
                <? if($v['PREVIEW_PICTURE'] || $v['PROPERTY_TIME_CLIP_VALUE']): ?>
                <div class="col-xs-2">
                	<?
                    	$renderImage = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
					?>
                	<a href="<?=CFile::GetPath($v['PREVIEW_PICTURE']);?>" class="fancybox"><img src="<?=$renderImage['src'];?>" class="right_img" /></a>
                    <br />
                    <div class="text-right-img"><?=$v['PROPERTY_TIME_CLIP_VALUE'];?></div>
                </div>
                <? endif; ?>
            </div>
            </div>
        </div>
        <div class="clear"></div>
        <? endforeach; ?>
    </div>
    
    <script>
		$("a.fancybox").magnificPopup({ 
  			type: 'image'
		});
	</script>
    <? endif; ?>
    
<div class="container step_2_station hide_after_order my-indent">
        <div class="row">

            <div class="col-xs-7 my-left-text">
            	<?=GetMessage("S_WHRITE_MAIL")?>
            </div>

        	<div class="col-xs-5">
            	<input id="email_vk" type="email" placeholder="Ваш E-mail" class="vk_input" value="<?=$arUser['EMAIL'];?>">
            </div>

            <div <? if($arResult['PROPERTIES']['FREE_PERIOD']['VALUE']): ?> style="display:none"<? endif; ?>>  
        </div>
    </div>
    
<div class="container" style="display:none">
        <div class="row">
            <div class="col-xs-7 my-left-text">
               	<?=GetMessage("S_ON_SLIDE_SHOW")?>
            </div>
            <div class="col-xs-5">
                <input no_logo_cost="<?=$logo_sett['PROPERTY_LOGO_COST_VALUE'];?>" type="checkbox" value="1" id="no_logo" checked="checked"/>
            </div>
        </div>
</div>
    
    <div class="show_hide_photogr_logo" style="display:none">                     
        <div class="clear"></div>
	    <div class="container logo_biz hide_after_order logo_photograph">
        	<h3 class="container_h3"><?=$logo_sett['PREVIEW_TEXT'];?></h3>
            <div style="margin:0 auto; width:868px;">
            	<div style="float:left; margin-right:39px">
            	   <input type="button" value="<?=GetMessage("S_ADD")?>" id="add_logo" class="btn btn-primary silver_btn">
                </div>
                <div id="logo_viz" class="logo_viz_brdr" logo_width="<?=$logo_sett['PROPERTY_LOGO_SIZE_VALUE'];?>">
    				<div class="logo_name"></div>
                    <div class="logo_img_div"></div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div id="answer" class="hide_after_order" style="text-align:center;"></div>

                        <form method="post" id="order_form" action="#" style="margin-top: 30px;">
                            <div style='display:none;' class="row">
                                <div class="form-group col-sm-6" style="padding-right:30px; width:46%;">
                                	<b><?=GetMessage("S_ENTER_NAME")?></b><br />
                                    <input id="name_feed" type="text" style="height:34px;" class="form-control">
                                </div><!-- /.form-group -->
                                <div class="form-group col-sm-6" style="width:46%;">
                                	<b><?=GetMessage("S_ENTER_EMAIL")?></b><br />
                                    <input id="email_feed" type="email" style="height:34px;" class="form-control">
                                </div><!-- /.form-group -->
                            </div>
                            
                            
             


    <div class="clear" style="padding-bottom:20px !important;"></div>
                            
                            <? if($arResult['PROPERTIES']['FREE_PRICE']['VALUE']):?>
                            	<? /*<div class="money">
                            		<h2 style="text-align:center;">
                                    	<?=GetMessage("S_COST")?> <span class="blue"><?=GetMessage("S_MORE_EQ")?> 10 <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?></span>
                                    </h2>
                                </div>*/?>
                            <? elseif($arResult['PROPERTIES']['COST']['VALUE']):?>
                            	<div class="money" style="display:none;">
                            		<h2 style="text-align:center;"><?=GetMessage("S_COST")?> <span class="blue"><span class="cost_m" real_cost="<?=$arResult['PROPERTIES']['COST']['VALUE']?>" plus_cost="<?=($arResult['PROPERTIES']['COST']['VALUE']+$logo_sett['PROPERTY_LOGO_COST_VALUE']);?>"><?=$arResult['PROPERTIES']['COST']['VALUE']?></span> <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?></span></h2>
                                    <div class="rasch_cost" style="text-align:center;font-size: 17px;">
                                    	<span class="inp_cost"><?=GetMessage("S_IN_COST")?></span><br />
                                        <ul>
                                        
                                        </ul>
                                    </div>
                                </div>
                            <? endif; ?>
                            
                           
							<? 
							$arFilter = Array(

   										"IBLOCK_TYPE"=>"clips", 
			
										"IBLOCK_ID"=>"35",

   										"ACTIVE"=>"Y", 

   										"PROPERTY_IP"=>$_SERVER["REMOTE_ADDR"]

   							);
		
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_BLOCK_FOR"));
							$stat = $res->GetNext();
							$_plural_days = array(GetMessage("S_DAY"), GetMessage("S_DAYS"), GetMessage("S_DAYS1")); 
							$day = round((strtotime($stat['PROPERTY_BLOCK_FOR_VALUE'])-time())/(3600*24));
							?>
                            <? if(((isset($_COOKIE['FREE_LIMIT']) && $_COOKIE['FREE_LIMIT'] == '1' && $arResult['PROPERTIES']['FREE_PERIOD']['VALUE']) || (isset($_COOKIE['PAID_LIMIT']) && $_COOKIE['PAID_LIMIT'] >=2 && !$arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])) && !$_REQUEST['test_f'] && 1==0): ?>
                            <h2 class="blue" style="text-align:center">
                            	<?=GetMessage("S_LIMIT")?>
                            </h2>
                            <? elseif(isset($stat['PROPERTY_BLOCK_FOR_VALUE']) && $stat['PROPERTY_BLOCK_FOR_VALUE'] && time() < strtotime($stat['PROPERTY_BLOCK_FOR_VALUE'])): ?>
                            <h2 class="blue" style="text-align:center">
                            	<?=sprintf(GetMessage("S_STOP_LIST"),$day.' '.$_plural_days[plural_type($day)]);?>
                            </h2>
                            <? else: ?>
                        
                            <div style="text-align:center;padding-top: 27px; margin-bottom: 40px;">
                                <input style="display:none;" type="button" value="<?=GetMessage("S_SEND")?>"  href="#text_before_submit_free" class="btn btn-primary btn_go order_clip_btn_popup">
                                <input onclick="yaCounter25315490.reachGoal('zakaz-video');" type="button" value="<?=GetMessage("S_SEND")?>"  href="#text_before_submit_free" class="btn btn-primary btn_go order_clip_btn check_before_submit">
                            </div>
                            <? endif; ?>
                        </form>
    
    </div>
    <div id="create_show step_2_station hide_after_order"></div>
    <div class="clear hide_after_order"></div>
    
    <?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}
$title=urlencode(GetMessage("S_TITLE")."Создаю свой клип из фото: http://fromfoto.com/fljvrFG/");
$url=urlencode('http://fromfoto.com/fljvrFG/');
//$url=urlencode("http://www.youtube.com/watch?v=8HwUuVt85uE");
$urlok=urlencode('http://fromfoto.com/fljvrFG/');
$titleok=urlencode(prepare_row('Бесплатно создаю клип из фотографий. Моё видео здесь: http://fromfoto.com/fljvrFG/'));
$summary=urlencode(prepare_row(GetMessage("S_DESCRIPTION"))); 
$image=urlencode('http://fromfoto.com/images/logo32.jpg');

	
	 /*if($arResult['PROPERTIES']['FREE_PERIOD']['VALUE']): ?>
    <?
    	$arFilter = Array(
   			"IBLOCK_ID"=>(SITE_ID == 'en')?22:17, 
   			"ACTIVE"=>"Y", 
   			"ID"=>(SITE_ID == 'en')?1310:1309
   		);
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
		$ar_fields = $res->GetNext();
	*/?>
    <div class="hide_after_order" style="display:none">
    	<div id="text_before_submit_free">
    		<p class="hh1" style="padding:9px 20px 0px;"><?=GetMessage("S_TITLE_1")?></h2>
    		<p><?=GetMessage("S_TITLE_2")?></p>
			<div class="soc_s" style="padding-bottom: 20px; padding-top: 25px;">
				<a href="#" onclick="yaCounter25315490.reachGoal('repost4');" class="a_order_clip_btn_vk btn_go" style="font-size: 12px; height: 38px; padding: 11px; width: 270px;">СДЕЛАТЬ РЕПОСТ</a>
				<!--<a href="#" class="a_order_clip_btn_ok"><img src="/images/ok.png" /><img src="/images/vk.png" /></a>-->
				<!--<a href="#" class="a_order_clip_btn_fb"><img src="/images/fb.png" /></a>-->
			</div>
			<br/>
    		<p style="width: 90%; margin: auto; font-size: 13px;"><?=GetMessage("S_TITLE_3")?></p>
        	<?=$ar_fields['PREVIEW_TEXT']; ?>
        </div>
    <script>
		$('#cboxClose').trigger('click');
	</script>
    </div>
    <script>
		$(".order_clip_btn_popup").colorbox({
			inline:true, 
			width:"650px", 
			height:"350px",
			overlayClose:false
		});
		$('.a_order_clip_btn_ok').click(function(e){
			e.preventDefault();
			//http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl={ссылка}&st.comments={комментарий}
			window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=$urlok;?>&st.comments=<?=$titleok;?>','sharer','toolbar=0,status=0,width=548,height=325');
			$('#cboxClose').trigger('click');
		});
		$('.a_order_clip_btn_fb').click(function(e){
			e.preventDefault();
			//window.open('https://www.facebook.com/','sharer','toolbar=0,status=0,width=548,height=325');
			window.open('http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo $title; ?>&p[summary]=<?php echo $summary; ?>&p[url]=<?php echo $url; ?>&p[images][0]=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
			$('#cboxClose').trigger('click');
		});

		
	</script>
    <style>
    	#cboxClose{
    		display: none;
    	}

    	#sleep_div{
    		width: 50%;
    		height: 50%;
    		border: 2px solid #5d7395;
    		color: black;
    		margin-top: 30px;
    	}
    	
    	#text_before_submit_free .soc_s{
    		text-align: center;
    	}
    	#text_before_submit_free .soc_s a{
    		display: inline-block;
    		padding: 15px;
    	}
		#text_before_submit_free .hh1{
			text-transform:uppercase;
			color:#5d7395;
			font-weight: bold;
			text-align: center;
			font-size: 25px;
			padding: 40px 20px 0;
		}
		#text_before_submit_free p{
			text-transform:uppercase;
			text-align: center;
			font-size: 16px;
		}
		/*.yes_know img,.no_know img{
			width: 35px;
   			margin-bottom: 6px;
    		margin-right: 4px
		}
		#text_before_submit_free{
			color:#4b65a6 !important;
			padding:10px; 
			background: rgb(209,219,231);
		}
		#cboxLoadedContent{
			}
		
		#text_before_submit_free a{
			color:#4b65a6 !important;
			text-decoration:none;
		}
		
		#text_before_submit_free h2,#text_before_submit_free h1,#text_before_submit_free h3{
			text-transform:uppercase;
			color:#4b65a6;
		}
		
		#text_before_submit_free ol{
			font-size:19px;
			margin-left:50px;
		}
		
		.yes_know{
			float:left;
		}
		.no_know{
			float:right;
		}
		.no_know, .yes_know{
			font-size: 20px;
    		font-weight: bold;
		}*/
		body{
			background:#fff !important;
		}
	</style>
    <?/* endif; */?>
 <? require_once('script_creation.php'); ?>
<? endif; ?>