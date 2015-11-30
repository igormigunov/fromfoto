<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
body{
	background:#fff !important;
}
body .footer-wrapper {
    background-color: #fff !important;
    color: #000 !important;
}
</style>
<?
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
$arSelect = array("PROPERTY_COUNT_SYMBOLS","PROPERTY_SECOND","PROPERTY_SIGN","ID","NAME");
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
			window.location = '/profile/';
		});
	});
</script>
<div class="container"><p style="font-size:25px; text-align:center; color:#000; font-weight:normal;"><?=GetMessage("S_YOUR_DATA")?></p></div>
<style>
	body{
		padding-top:0px !important;
	}
</style>
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




<div class="container hide_after_order">
    	<?
        	$_plural_images = array(GetMessage("S_IMAGE"), GetMessage("S_IMAGES"), GetMessage("S_IMAGES1"));
			$count_pictures = "<span class='blue'>".sizeof($photo)."</span> ".$_plural_images[plural_type(sizeof($photo))];
		
		?>
		<h3 class="container_h3" style="text-align:center;"><?=sprintf(GetMessage("S_STEP"),$show_step);?>
        <? $show_step++; ?>
        <span id="count_pictures_container"><? printf(GetMessage("S_UPLOAD_PICTURES"),$count_pictures);?></span><span style="display:none;" id="all_pictures_container"><? printf(GetMessage("S_ALL_PHOTO_COMPLETE"),$count_pictures);?></span></h3>
        <div class="imgs_uploader">
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="/ajax/upload.php" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7" style="padding-top:20px; padding-left:55px; width:100%;">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button silver_btn btn-primary" style=" margin-right:40px"><div style="padding:0px; margin:0px; height:8px;" ></div>
                    <i class="glyphicon glyphicon-plus"></i>
                    <span><?=GetMessage("S_ADD_FILES")?></span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="button" class="btn btn-danger delete silver_btn btn-primary">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span><?=GetMessage("S_DELETE")?></span>
                </button>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade" style="margin-left:45px;">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>

        
        </div>
    </div>
<div class="clear hide_after_order" style="padding-bottom:10px !important;"></div>
<div class="error_size hide_after_order" style="text-align:center; font-size:28px; color:#F00;"></div>
<div class="clear hide_after_order" style="padding-bottom:36px !important;"></div>

<? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])):?>
	<div class="video_maket new_video_maket step_2_station hide_after_order">
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
	<div class="video_work_station step_2_station hide_after_order">
    	<div class="img_area">
        	<div class="img_block">
    			<div style="display:none;" class="show_text"></div>
       			<div style="display:none;" class="min_size"><?=GetMessage("S_MINIMUM_SIZE")?></div>
        		<div class="clip_imgs"></div>
			</div>
        </div>
        <div class="next_prev_img" style="padding-left: 125px;">
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
    
    <div class="clear hide_after_order"></div>
    <div class="error_vertical hide_after_order" style="text-align:center; font-size:28px; color:#F00; display:none;">
    	<div class="error_text" style="text-align:center; padding-top: 20px;"></div>
        <div style="text-align:center;padding-top: 15px;"><input type="button" class="btn btn-primary silver_btn" href="#text_before_submit_free" id="show_how_clip_btn" value="<?=GetMessage("S_HOW_TO")?>"></div>
    </div>
    <div class="clear hide_after_order" style="padding-bottom:30px !important;"></div>
    <div class="error_size hide_after_order" style="text-align:center; font-size:28px; color:#F00;"></div>
    
    <div class="container step_2_station hide_after_order">
    	<div class="player">
    	<div id="time_time" style="display:none">0</div>
		<div style="text-align:center; width:660px; margin:auto;"><h3 class="container_h3 step_2_station" style="text-align:center;"><?=sprintf(GetMessage("S_STEP"),$show_step);?><?=GetMessage("S_CONTROL_BUTTONS")?></h3></div>
        <? $show_step++; ?>
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
    
    
    
    
    <? if($arResult['PROPERTIES']['WITH_LOGO']['VALUE']):?>
    <div class="clear hide_after_order" style="padding-bottom:50px !important;"></div>
    <div class="container step_2_station logo_biz hide_after_order">
    	<h3 class="container_h3" style="text-align:center;"><?=sprintf(GetMessage("S_STEP"),$show_step);?><?=GetMessage("S_ADD_LOGO")?></h3>
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
    <? endif;?>
    
    <div class="clear hide_after_order" style="padding-bottom:50px !important;"></div>
    <div class="container step_2_station hide_after_order">
    	<h3 class="container_h3" style="text-align:center;"><?=sprintf(GetMessage("S_STEP"),$show_step);?><?=GetMessage("S_ADD_MP3")?></h3>
        <? $show_step++; ?>
        <div style="margin:0 auto; width:1090px;" class="mp3_hover_out">
        	<div style="float:left; margin-right:39px">
        	<input type="button" value="<?=GetMessage("S_ADD")?>" id="add_mp3" class="btn btn-primary silver_btn">
            </div>
            <div style="float:left; margin-right:39px">
        	<input type="button" value="<?=GetMessage("S_RETURN")?>" id="return_mp3" class="btn btn-primary silver_btn">
            </div>
            
            <?
            	$file_path = CFile::GetPath($arResult['PROPERTIES']['AUDIO_MP3']['VALUE']);
				$paths = explode("/",$file_path);
				$file_name = $paths[sizeof($paths)-1];
			?>
            <div id="mp3_viz">
            	<div class="audio_name">
                	<img src="<?=SITE_TEMPLATE_PATH?>/img/music.png" />
                    <div class="mp3_name"><?=$file_name; ?></div>
                </div>
                <div id="audio_player">
            		<audio id="audio_player_cl" src="<?=CFile::GetPath($arResult['PROPERTIES']['AUDIO_MP3']['VALUE']);?>" preload="auto"></audio>
                </div>
            </div>
        	<div path='<?=$file_path;?>' id="path_to_mp3"></div>
            
            <div path='<?=$file_path;?>' id="path_to_return_mp3" mp3_name="<?=$file_name; ?>"></div>
        </div>
        
    </div>
    
    
    
    <? if($texts): ?>
    <div class="clear hide_after_order" style="padding-bottom:50px !important;"></div>
    <div class="container step_2_station hide_after_order">
    	<h3 class="container_h3" style="text-align:center;"><?=sprintf(GetMessage("S_STEP"),$show_step);?><?=GetMessage("S_ENTER_TEXTS")?></h3>
        <? $show_step++; ?>
        <? $num = 0; ?>
    	<? foreach($texts as $k=>$v): ?>
        <? $num++; ?>
        <div>
        	<h3 class="container_h3" style="text-align:center; padding-top:15px;"><span class='blue'>
            <?=GetMessage("S_TEXT_NUM")?> <?=$num;?>:<br /> 
			<? if($v['PROPERTY_COUNT_SYMBOLS_VALUE']): ?>
            	<?=GetMessage("S_RESTRICTION")?> <span class="count_text_value"><?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?></span> <?=GetMessage("S_CHARACTERS")?>.
			<? else: ?>
				<?=GetMessage("S_NO_RESTRICTION")?>.
			<? endif; ?>
            </span></h3>
        	<div class="texts_div"><textarea <? if($v['PROPERTY_SIGN_VALUE']):?> placeholder="<?=$v['PROPERTY_SIGN_VALUE']; ?>"<? endif; ?> style="font-size:25px;" class="text_inp text_show_<?=$k;?>" size_value="<?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?>" ></textarea></div>
        </div>
        <? endforeach; ?>
    </div>
    <? endif; ?>
    
    <div class="clear hide_after_order" style="padding-bottom:60px !important;"></div>
    <div class="container step_2_station hide_after_order" >
    <h3 class="container_h3 hide_after_order" style="text-align:center;"><?=sprintf(GetMessage("S_STEP"),$show_step);?><?=GetMessage("S_SEND_YOUR_DATA")?></h3>
    
    <? $show_step++; ?>
    <div id="answer" class="hide_after_order" style="text-align:center;"></div>

                        <form method="post" id="order_form" action="#">
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
                            <div <? if($arResult['PROPERTIES']['FREE_PERIOD']['VALUE']): ?> style="display:none"<? endif; ?> class="row">
                            	<div class="no_logo" style="width:680px; text-align:center; margin:0 auto;"><input no_logo_cost="<?=$logo_sett['PROPERTY_LOGO_COST_VALUE'];?>" type="checkbox" value="1" id="no_logo" /><label for="no_logo" style="cursor:pointer; font-size:24px; color:#3e3e3e; padding-top: 4px;"><?=GetMessage("S_NO_LOGO")?></label></div>
                            </div>
                            
             

<div class="show_hide_photogr_logo" style="display:none">                     
    <div class="clear" style="padding-bottom:30px !important;"></div>
    <div class="container step_2_station logo_photograph">
    	<h3 class="container_h3" style="text-align:center;"><?=$logo_sett['PREVIEW_TEXT'];?></h3>
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
    <div class="clear" style="padding-bottom:20px !important;"></div>

                            
                            <? if($arResult['PROPERTIES']['FREE_PRICE']['VALUE']):?>
                            	<? /*<div class="money">
                            		<h2 style="text-align:center;">
                                    	<?=GetMessage("S_COST")?> <span class="blue"><?=GetMessage("S_MORE_EQ")?> 10 <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?></span>
                                    </h2>
                                </div>*/?>
                            <? elseif($arResult['PROPERTIES']['COST']['VALUE']):?>
                            	<div class="money">
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
                            <? if(((isset($_COOKIE['FREE_LIMIT']) && $_COOKIE['FREE_LIMIT'] == '1' && $arResult['PROPERTIES']['FREE_PERIOD']['VALUE']) || (isset($_COOKIE['PAID_LIMIT']) && $_COOKIE['PAID_LIMIT'] >=2 && !$arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])) && !$_REQUEST['test_f']): ?>
                            <h2 class="blue" style="text-align:center">
                            	<?=GetMessage("S_LIMIT")?>
                            </h2>
                            <? elseif(isset($stat['PROPERTY_BLOCK_FOR_VALUE']) && $stat['PROPERTY_BLOCK_FOR_VALUE'] && time() < strtotime($stat['PROPERTY_BLOCK_FOR_VALUE'])): ?>
                            <h2 class="blue" style="text-align:center">
                            	<?=sprintf(GetMessage("S_STOP_LIST"),$day.' '.$_plural_days[plural_type($day)]);?>
                            </h2>
                            <? else: ?>
                        
                            <div style="text-align:center;padding-top: 27px;"><input onclick="yaCounter25315490.reachGoal('zakaz-video');" type="button" value="<?=GetMessage("S_SEND")?>" <? if(!$arResult['PROPERTIES']['FREE_PERIOD']['VALUE']): ?>id="order_clip_btn"<? endif; ?> href="#text_before_submit_free" class="btn btn-primary silver_btn order_clip_btn"></div>
                            <? endif; ?>
                        </form>
    
    </div>
    <div id="create_show step_2_station hide_after_order"></div>
    
    
    <div class="clear hide_after_order"></div>
    
    <? if($arResult['PROPERTIES']['FREE_PERIOD']['VALUE']): ?>
    <?
    	$arFilter = Array(
   			"IBLOCK_ID"=>(SITE_ID == 'en')?22:17, 
   			"ACTIVE"=>"Y", 
   			"ID"=>(SITE_ID == 'en')?1310:1309
   		);
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
		$ar_fields = $res->GetNext();
	?>
    <div class="hide_after_order step_2_station" style="display:none">
    	<div id="text_before_submit_free">
        	<?=$ar_fields['PREVIEW_TEXT']; ?>
            <br /><br />
            <div style="position:absolute; bottom: 10px; width: 550px;">
            	<div class="yes_know">
            		<a href="/#menu-choose"><img src="<?=SITE_TEMPLATE_PATH?>/img/yes_symbol.png"><?=GetMessage("S_YES_KNOW");?></a>
            	</div>
            	<div class="no_know">
            		<a href="#" class="a_order_clip_btn"><img src="<?=SITE_TEMPLATE_PATH?>/img/yes_symbol.png"><?=GetMessage("S_NO_KNOW");?></a>
            	</div>
            </div>
        </div>
    </div>
    <script>
		$(".order_clip_btn").colorbox({
			inline:true, 
			width:"600px", 
			height:"500px"
		});
		$('.a_order_clip_btn').click(function(e){
			e.preventDefault();
			$('#cboxClose').trigger('click');
		});
		


		
	</script>
    <style>
		.yes_know img,.no_know img{
			width: 35px;
   			margin-bottom: 6px;
    		margin-right: 4px
		}
		#text_before_submit_free{
			color:#4b65a6 !important;
			padding:10px; 
			background: rgb(209,219,231); /* Old browsers */


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
		}
		body{
			background:#fff !important;
		}
	</style>
    <? endif; ?>
 <? require_once('script_creation.php'); ?>
<? endif; ?>