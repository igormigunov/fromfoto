<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//выбор фотографий для данного клипа
$arFilter = Array(
   "IBLOCK_ID"=>"31", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($arResult['PROPERTIES']['PHOTO']['VALUE'])? $arResult['PROPERTIES']['PHOTO']['VALUE']:-1
   );
$arSelect = array("PROPERTY_SIZE","PROPERTY_SECOND","ID","NAME");
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
$arSelect = array("PROPERTY_COUNT_SYMBOLS","PROPERTY_SECOND","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$texts = array();
while($ar_fields = $res->GetNext())
{
  $texts[] = $ar_fields;
}

?>

<? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])):?>
	<div class="video_maket new_video_maket">
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
	<div class="video_work_station">
    	<div class="img_area">
        	<div class="img_block">
    			<div style="display:none;" class="show_text"></div>
       			<div style="display:none;" class="min_size"><?=GetMessage("S_MINIMUM_SIZE")?></div>
        		<div class="clip_imgs"></div>
			</div>
        </div>
        <? if($_REQUEST['show']):?>
        <div class="next_prev_img">
        	<div class="prev_img">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/left_str.png" style="border:none;" />
            </div>
            <div class="text_scrl">
            	<?=GetMessage("S_ALIGN_PHOTO")?> <span class="blue num_align_photo"></span>
            </div>
            <div class="next_img">
            	<img src="<?=SITE_TEMPLATE_PATH?>/img/right_str.png" style="border:none;" />
            </div>
        </div>
        <div class="clear"></div>
        <? endif;?>
    </div>
    
    
    <div class="clear" style="padding-bottom:20px !important;"></div>
    <div class="error_size" style="text-align:center; font-size:28px; color:#F00;"></div>
    
    <div class="container">
    	<div class="player">
    	<div id="time_time" style="display:none">0</div>
		<div style="text-align:center; font-size:18px;"><b><?=GetMessage("S_CONTROL_BUTTONS")?></b></div>
        <div class="synchronization">
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
    
    
    
    <div class="clear" style="padding-bottom:8px !important;"></div>
    <div class="container">
    	<?
        	$_plural_images = array(GetMessage("S_IMAGE"), GetMessage("S_IMAGES"), GetMessage("S_IMAGES1"));
			$count_pictures = "<span class='blue'>".sizeof($photo)."</span> ".$_plural_images[plural_type(sizeof($photo))];
		
		?>
		<h3 class="container_h3" id="count_pictures_container" style="text-align:center;"><? printf(GetMessage("S_UPLOAD_PICTURES"),$count_pictures);?></h3>
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
    
    <div class="clear" style="padding-bottom:50px !important;"></div>
    <div class="container">
    	<h3 class="container_h3" style="text-align:center;"><?=GetMessage("S_ADD_MP3")?></h3>
        <div style="margin:0 auto; width:1065px;">
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
    <div class="clear" style="padding-bottom:50px !important;"></div>
    <div class="container">
    	<h3 class="container_h3" style="text-align:center;"><?=GetMessage("S_ENTER_TEXTS")?></h3>
    	<? foreach($texts as $k=>$v): ?>
        
        <div>
        	<h3 class="container_h3" style="text-align:center; padding-top:15px;"><span class='blue'>
			<? if($v['PROPERTY_COUNT_SYMBOLS_VALUE']): ?>
            	<?=GetMessage("S_RESTRICTION")?> <span class="count_text_value"><?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?></span> <?=GetMessage("S_CHARACTERS")?>.
			<? else: ?>
				<?=GetMessage("S_NO_RESTRICTION")?>.
			<? endif; ?>
            </span></h3>
        	<div class="texts_div"><textarea style="font-size:25px;" class="text_inp text_show_<?=$k;?>" size_value="<?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?>" ></textarea></div>
        </div>
        <? endforeach; ?>
    </div>
    <? endif; ?>
    
    <div class="clear" style="padding-bottom:60px !important;"></div>
    <div class="container">
    <h3 class="container_h3" style="text-align:center;"><?=GetMessage("S_SEND_YOUR_DATA")?></h3>
    <div id="answer" style="text-align:center;"></div>

                        <form method="post" id="order_form" action="#">
                            <div class="row">
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
                            	<div class="no_logo" style="width:500px; text-align:center; margin:0 auto;"><input type="checkbox" value="1" id="no_logo" /><label for="no_logo" style="cursor:pointer; font-size:24px; color:#3e3e3e; padding-top: 4px;">хочу видео без логотипа (+50% к стоимости)</label></div>
                            </div>
                            
                            <? if($arResult['PROPERTIES']['COST']['VALUE']):?>
                            	<div class="money">
                            		<h2 style="text-align:center;"><?=GetMessage("S_COST")?> <span class="blue"><span class="cost_m" real_cost="<?=$arResult['PROPERTIES']['COST']['VALUE']?>" plus_cost="<?=($arResult['PROPERTIES']['COST']['VALUE']*1.5)?>"><?=$arResult['PROPERTIES']['COST']['VALUE']?></span> <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?></span></h2>
                                </div>
                            <? endif; ?>

                            <div style="text-align:center;padding-top: 27px;"><input type="button" value="<?=GetMessage("S_SEND")?>" id="order_clip_btn" class="btn btn-primary silver_btn"></div>
                        </form>
    
    </div>
    <div id="create_show"></div>
    
    
    <div class="clear"></div>
 

<? require_once('script_creation.php'); ?>