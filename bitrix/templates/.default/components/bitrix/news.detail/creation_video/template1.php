<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->SetViewTarget("add_content_class"); ?>with_out_border<? $this->EndViewTarget(); ?>
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
?>
<script src="<?=$templateFolder?>/script.js"></script>

<div class="page-title"><span>шаблон <?=$arResult["NAME"]?></span></div>
<div class="template-video">
	<?=$arResult['DISPLAY_PROPERTIES']['PREV_VIMEO2']['~VALUE'];?>
</div>

      <div class="template-step margin">
        <span>ШАГ 1</span> 
		<font id="count_pictures_container"><?printf(GetMessage("FF_ST1_TITLE"), sizeof($arResult["PHOTO"]));?></font>
		<font style="display:none;" id="all_pictures_container"><?=GetMessage("S_ALL_PHOTO_COMPLETE");?></font>
      </div>
	  
	  <form id="fileupload" action="/ajax/upload.php" method="POST" enctype="multipart/form-data">
      <div class="upload-wrap">
        <div class="upload-button add-photo">
          <div class="upload-button-container">
            <span><?=GetMessage("FF_BUT_ADD")?></span>
            <input type="file" name="files[]" multiple>
          </div>
        </div>
        <div class="upload-button delete-photo" style="cursor: pointer;" >
          <div class="upload-button-container">
            <span><?=GetMessage("FF_BUT_DEL")?></span>
            <input type="button" style="cursor: pointer;" >
          </div>
        </div>
      </div>
	  <div role="presentation" class="table table-striped imgs_uploader"><ul class="upload-table files"></ul></div>
	  </form>
	<div class="step_second">
      <div class="template-step">
        <span>ШАГ 2</span> <?=GetMessage("FF_ST2_TITLE")?>
      </div>
      <div class="upload-wrap">
        <div class="upload-button add-music">
        <?
           	$file_path = CFile::GetPath($arResult['PROPERTIES']['AUDIO_MP3']['VALUE']);
			$paths = explode("/",$file_path);
			$file_name = $paths[sizeof($paths)-1];
		?>
          <div class="upload-button-container add_mp3" style="cursor:pointer;">
            <span><?=GetMessage("FF_BUT_ADD_AUDIO")?></span>
            <input id="fileupload" type="button" />
          </div>
        </div>
      </div>  
      <ul class="upload-table-music">
		<? $file_path = CFile::GetPath($arResult['PROPERTIES']['AUDIO_MP3']['VALUE']); ?>
        <li src="<?=$file_path; ?>" ><span class="mp3_name"><?=$file_name;?></span></li>
		<span path='<?=$file_path;?>' id="path_to_mp3"></span>
		<span path='<?=$file_path;?>' id="path_to_return_mp3" mp3_name="<?=$file_name; ?>"></span>
        <a href="#" id="return_mp3" class="music-button"><?=GetMessage("FF_BUT_RE_AUDIO")?></a>
      </ul>

<?if($arResult["TEXTS"]):?>
<? 
   		$newWidth = 193;
		$newHeight = 108;
?>
      <div class="template-step">
        <span>ШАГ 3</span> <?=GetMessage("FF_ST3_TITLE")?>
      </div>
      <!--<form class="template-form">-->
	<?foreach($arResult["TEXTS"] as $k=>$v):?>
		<? $num++; ?>
        <div class="template-text">
          <div class="template-text-container">
            <p>ТЕКСТ <?=$num;?>
            <? if($v['PROPERTY_COUNT_SYMBOLS_VALUE']): ?>
				<span class="template-text-note"><span class="count_text_value"><?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?></span> символов</span>
			<? endif; ?>
			</p>
            <textarea class="text-field text_inp" size_value="<?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?>" placeholder="Напишите сюда ваш текст до <?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?> символов"></textarea>
          </div>
          <div class="template-text-video">
          <? if($v['PREVIEW_PICTURE'] || $v['PROPERTY_TIME_CLIP_VALUE']): ?>
               	<?
                   	$renderImage = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
				?>
	            <img src="<?=$renderImage['src'];?>">
	            <span><?=$v['PROPERTY_TIME_CLIP_VALUE'];?></span>
          <? endif; ?>
          </div>
        </div>
 	<?endforeach;?>
<?endif;?>
        <div class="mail">
          <span><?=GetMessage("FF_FROM_EMAIL")?></span> 
          <input id="email_feed" type="text" placeholder="почта">
        </div>
        <div class="slide-title-FOC">
          <span><?=GetMessage("FF_MESS1")?></span> 
        </div>
		<div style="text-align:center;" class="hide_after_order" id="answer"></div>
        <input type="submit" class="button-slide order_clip_please" value="<?=GetMessage("FF_BUT_SEND")?>">
		<div class="pay_block" style="display: none;"></div>
      <!--</form>-->
	  </div>
      
      
<?// окно редактирования -----------------------------------------------------------------------------?>
	<? $num=0;?>
	  <? foreach($photo as $k=>$v):?>
      <div class="popup popup_<?=$num; ?>" style="display: none;">
        <div class="popup-container">
          <div class="content-title bold-title">
            внимание! это фото не поместится целиком! 
            <p class="content-title-small">выберите область на фото, которая попадёт в клип</p>
          </div>
          <div class="popup-cuted-image">
            <img src="<?=SITE_TEMPLATE_PATH?>/images/cut-photo.jpg" alt="" id="cut-photo">
          </div>
          <div class="popup-links">
            <a href="#" class="button-tab save_go">сохранить и продолжить</a>
          </div>
        </div>
      </div>  
	  <? $num++; ?>
	<? endforeach; ?>	  

<?// -------------------------------------------------------------------------------------------------?>



<?

$tmp = "";

if($_COOKIE['UPLOAD_FILES']){

	$tmp = $_COOKIE['UPLOAD_FILES']."/";

}

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/ajaxupload.js"></script>
<script>
	var settings = [];
	var coords = [];
	
	<? foreach($photo as $k=>$v):?>
		
		<? $no_video = ($v['PROPERTY_NO_VIDEO_VALUE'])?1:0; ?>
		
		<? $time = explode("-",$v['PROPERTY_SECOND_VALUE']); ?>
		
		<? $delim = array('x','X','х','Х');?>
		
		<? 
			$x = 0;
			do{
				$size = explode($delim[$x],$v['PROPERTY_SIZE_VALUE']);
				$x++;
			}while(sizeof($size)<2&&isset($delim[$x]));
			
			$real_size = array();
			
			$size[0] = intval($size[0]);
			$size[1] = intval($size[1]);
			
			$real_size[0] = intval($size[0]);
			$real_size[1] = intval($size[1]);
		?>
		
		<?if(is_array($arData[$k])):?>
			<?if(intval($arData[$k]['width']) != intval($real_size[0]) || intval($arData[$k]['height']) != intval($real_size[1])):?>
				coords.push([0,0,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1]);
			<?else:?>
				coords.push([<?=trim(intval($arData[$k]['x1']));?>,<?=trim(intval($arData[$k]['x2']));?>,<?=trim(intval($arData[$k]['y1']));?>,<?=trim(intval($arData[$k]['y2']));?>,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1]);
			<?endif;?>		
		<?else:?>
			coords.push([0,0,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1]);
		<?endif;?>		

		<? for($i=trim($time[0]);$i<trim($time[1]);$i++):?>

			settings.push([<?=$k;?>,<?=$i;?>,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=$no_video;?>]);

		<? endfor;?>

	<? endforeach; ?>
	
	<? $num=0;?>
	var jcrop_api = [];
	<? foreach($photo as $k=>$v):?>
	jQuery(".popup_<?=$num; ?> #cut-photo").Jcrop({

	},function(){
		jcrop_api[<?=$num; ?>] = this;
	});
	<? $num++;?>
	<? endforeach; ?>
	
	var num;
	var work_area_height = $(window).height()/1.6;
	var work_area_whidth = $('.content-container').width()/1.1;

	jQuery(document).on("click", ".show_popup", function(event){
		event.preventDefault();
		width_pict = jQuery(this).find("img").attr('real_width');
		height_pict = jQuery(this).find("img").attr('real_height');

		if((work_area_height/height_pict < work_area_whidth/width_pict)){
			while(height_pict>work_area_height){
				del = work_area_height/height_pict;
				height_pict = work_area_height;
				width_pict = Math.floor(width_pict*del);	
			}
		}else{
			while(width_pict>work_area_whidth){
				del = work_area_whidth/width_pict;
				width_pict = work_area_whidth;
				height_pict = Math.floor(height_pict*del);	
			}
		}
		num = $( ".upload-table li" ).index( this );
		new_width_jcrop = settings[num][4];
		new_height_jcrop = settings[num][5];
		
		while(new_width_jcrop>work_area_whidth || new_height_jcrop>work_area_height){
			del = 1;
			if(new_width_jcrop>work_area_whidth){
				del = work_area_whidth/new_width_jcrop;
				new_width_jcrop = work_area_whidth;
				new_height_jcrop =  Math.floor(new_height_jcrop*del);
			}
			else if(new_height_jcrop>work_area_height){
				del = work_area_height/new_height_jcrop;
				new_height_jcrop = work_area_height;
				new_width_jcrop =  Math.floor(new_width_jcrop*del);	
			}
		}
							
		if(height_pict < new_height_jcrop){
			del = new_height_jcrop/height_pict;
			height_pict = new_height_jcrop;
			width_pict = Math.floor(width_pict*del);
		}else if(width_pict < new_width_jcrop){
			del = new_width_jcrop/width_pict;
			width_pict = new_width_jcrop;
			height_pict = Math.floor(height_pict*del);
		}
		
		if(!jQuery('.popup_'+num).hasClass('opened')){
			jcrop_api[num].setOptions({ 
				boxWidth: width_pict,
				boxHeight: height_pict,
				onChange : showCoords,
				onSelect : showCoords,
				allowResize: false,
				allowSelect: false
			});
			$('.popup_'+num+' #cut-photo').attr('src', jQuery(this).find("img").attr("href"));
			jcrop_api[num].setImage(jQuery(this).find("img").attr("href"));
		
			jcrop_api[num].animateTo([ 0, 0, new_width_jcrop, new_height_jcrop ]);
		}
		//для беты
		$('.popup_'+num+' .jcrop-holder').css("margin-left", "-"+$('.jcrop-holder').width()/2+"px");
		$('.popup_'+num+' .jcrop-holder').css("left", "50%");
		setTimeout(function() { 
			$('.popup_'+num+' .jcrop-holder').css("margin-left", "-"+$('.jcrop-holder').width()/2+"px");
			$('.popup_'+num+' .jcrop-holder').css("left", "50%");
		}, 400);
			
		jQuery('.popup_'+num).show();
		jQuery('.popup_'+num).addClass('opened');
	});
	
	function showCoords(c){
		x1 = c.x; $('#x1').val(c.x);		
		y1 = c.y; $('#y1').val(c.y);		
		x2 = c.x2; $('#x2').val(c.x2);		
		y2 = c.y2; $('#y2').val(c.y2);

		coords[settings[num][0]][0] = x1;
		coords[settings[num][0]][1] = x2;
		coords[settings[num][0]][2] = y1;
		coords[settings[num][0]][3] = y2;
	}

	jQuery(document).on("click", ".save_go", function(event){
		event.preventDefault();
		jQuery(".popup").hide();
	});
	
	$('#return_mp3').click(function(e) {
		e.preventDefault();
		_path = $('#path_to_return_mp3').attr('path');
		_mp3_name = $('#path_to_return_mp3').attr('mp3_name');

		$('#path_to_mp3').attr('path',_path);
						
		$('.mp3_name').html(_mp3_name);
    });
	
	new AjaxUpload($('.add_mp3'),{
		action: '/ajax/upload_mp3.php',
		name: 'uploadmp3',
		onSubmit: function(file, ext){
			if(!(ext &&  /^(mp3)$/.test(ext))){
				alert('<?=GetMessage("S_ONLY_MP3")?>');
				return false;
			};
			$('.mp3_name').html('<?=GetMessage("S_PROCESSING")?>');
		},
		onComplete: function(file, response){
			if($(response).find('answer').text() == 'ok'){				
				$('#path_to_mp3').attr('path','/upload/tmp/<?=$tmp; ?>' + $(response).find('file').text());
				$('.mp3_name').html(file);
			}
			else{
				alert('<?=GetMessage("S_COULD_NOT_LOAD")?>');
				$('#return_mp3').trigger('click');
			};
		}
	});
	
	function show_ret_mp3(){
		if($('#path_to_return_mp3').attr('mp3_name') != $('.mp3_name').text() && $('.mp3_name').text() !='<?=GetMessage("S_PROCESSING")?>'){
			$('#return_mp3').show();
		}else{
			$('#return_mp3').hide();
		}
	}
	

	var count_pictures = '<?=sizeof($arResult["PHOTO"]); ?>';
	var timer_change_count_text_photo = setTimeout(function change_count_text_photo() {
		var difference = parseInt(count_pictures) - parseInt($('.upload-table .show_popup img').length);
		timer_change_count_text_photo = setTimeout(change_count_text_photo, 1000);
		if(difference > 0){
			$('#count_pictures_container .count_photo').html(difference);
			$('#count_pictures_container').show();
			$('#all_pictures_container').hide();
			$('.step_second').hide();
		}else{
			$('.step_second').show();
			$('#count_pictures_container').hide();
			$('#all_pictures_container').show();
			show_ret_mp3();
		}
	}, 1000);
	
	$(".text_inp").keyup(function(){
		var size_value = parseInt($(this).attr('size_value'));
        if($(this).val().length > size_value && size_value > 0){
        	$(this).val($(this).val().substr(0, size_value));
        }
		var count_simbols = parseInt(size_value) - parseInt($(this).val().length);
		$('.count_text_value', $(this).parent()).html(count_simbols);
	});

	$('html').keyup(function(e){
    	if(e.keyCode == 46){
			$('.delete-photo').trigger('click');	
		}
	});
	
	$('.delete-photo').click(function(){
		$('li.show_popup img').each(function(index, element) {
            if($(this).hasClass("ui-selected")){
				_this = $(this);
				_this.closest('li.show_popup').remove();
				$.ajax({
					url: "/ajax/upload.php" + '?' + $.param({"file": _this.attr("file_name")}),
   					type: 'DELETE'
				}).done(function() {
					
				});
			}
        });  
	});

	$( ".imgs_uploader" ).selectable({ 
		filter: "li.show_popup img",
		start: function( event, ui ) {
			// return;
		},
		stop: function( event, ui ) {
			// return;
		}
	});
	
	$(".table-striped .files").sortable({
	    	opacity: 0.6,		
			tolerance:'pointer',
	    	start: function(event, ui) {
	    		$('li.show_popup img').removeClass('ui-selected');
			},
	    	stop: function(event, ui) {
				var imgs = [];
				$("li.show_popup img").each(function(){
					imgs.push($(this).attr('file_name'));
				});
				$.post("/ajax/resorting.php", {imgs:imgs}, function(responseText){
				});
			
				$('.img_prev_upl img').each(function(index, element) {
                    if($(this).hasClass('ui-selected')){
						$(this).removeClass('ui-selected');
						$(this).trigger('click');
						return false;
					}
                });
			}
	});
	
	$(".order_clip_please").click(function(e){

		e.preventDefault();		

		$("#answer").html('<?=GetMessage("S_PROCESSING")?>');

		$(".order_clip_please").hide();

		var imgs = [];
		
		var check_work = 0;
		
		var user_logo = 0;
		var user_width = 0;
		var user_logo_src = 0;
		
		if($('.logo_biz #logo_viz .logo_img').length){
			user_logo = 1;
			user_width = $('.logo_biz #logo_viz').attr('logo_width');
			user_logo_src = $('.logo_biz #logo_viz .logo_img').attr('src');
		}
		
		var ph_user_logo = 0;
		var ph_user_width = 0;
		var ph_user_logo_src = 0;
		
		if($('.logo_photograph #logo_viz .logo_img').length){
			ph_user_logo = 1;
			ph_user_width = $('.logo_photograph #logo_viz').attr('logo_width');
			ph_user_logo_src = $('.logo_photograph #logo_viz .logo_img').attr('src');
		}

		$(".show_popup img").each(function(index, element){
			if(coords[index]){
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($(window).height()/1.6);
				imgs.push($(this).attr('href'));
			}
		});		

		var texts = [];
		$("textarea.text_inp").each(function(){
			texts.push($(this).val());
		});
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
		
		
		var no_logo = ($('#no_logo').is(":checked"))? 1:0;
		$.post("<?=SITE_DIR?>ajax/create_clip.php", {free_period:free_period,SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>', coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_feed").val(), email_vk:$("#email_feed").val(), name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), vk:1, video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', user_logo:user_logo, user_width:user_width, user_logo_src:user_logo_src, ph_user_logo:ph_user_logo, ph_user_width:ph_user_width, ph_user_logo_src:ph_user_logo_src, section_text_id:"<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>"}, function(data){

			if(data == 1){
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
						setcookie("PAID_LIMIT",parseInt(getCookie('PAID_LIMIT'))+1,expire,'/');
					}else{
						setcookie("PAID_LIMIT",1,expire,'/');
					}
				}
				
								
				$.post("<?=SITE_DIR?>ajax/create_clip2.php", {<? if($_REQUEST['best']):?>make_dir:'best_zakaz', <? endif; ?>free_period:free_period, coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_feed").val(), vk:1, email_vk:$("#email_vk").val(),  name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', user_logo:user_logo, user_width:user_width, user_logo_src:user_logo_src, ph_user_logo:ph_user_logo, ph_user_width:ph_user_width, ph_user_logo_src:ph_user_logo_src}, function(data){
					<? if($_REQUEST['best']):?>
						$.post("<?=SITE_DIR?>ajax/submit_pay.php", {}, function(data){
							if(data != '1'){
								$('.pay_block').html(data);
								$('#PayForm').submit();
							}else{
								$("#answer").html('<div style="text-align:center;" id="answer"><br /><?=GetMessage("S_READY_PAY")?><br /><br /></div>');
							}
						});
					<? else: ?>
						setTimeout(function(){window.location = '/complite/';}, 1000);	
					<? endif; ?>
				});
			}else{
				$("#answer").html(data);
				$(".order_clip_please").show();
			}
		});
	})

	var er_file_types = '<?=GetMessage("S_ER_FILE_TYPES")?>';
	var er_maxFileSize = '<?=GetMessage("S_MAX_FILE_SIZE")?>';
	var er_minFileSize = '<?=GetMessage("S_MIN_FILE_SIZE")?>';
	var er_maxNumberOfFiles = '<?=GetMessage("S_MAX_NUMBR_FILES")?>';
	var free_period = '<? echo ($arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])? '1':'' ?>';
</script>

<!-- The template to display files available for upload -->

<script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}

	<li class="show_popup">
		<img style="height: 40px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />
	</li>

{% } %}

</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
	{% if (!file.error && file.thumbnailUrl) { %}
	<li class="show_popup">        
		{% if (file.thumbnailUrl) { %}
            <img href="{%=file.url%}" real_width="{%=file.real_width%}" real_height="{%=file.real_height%}" file_name="{%=file.name%}" uniq_name="{%=file.name%}-{%=i%}" src="{%=file.thumbnailUrl%}">
		{% } %}
	</li>
	{% } %}
	{%=file.type%}
	{% if (!file.error && (file.name.match( /\.mp4/i ) || file.name.match( /\.avi/i ) || file.name.match( /\.flv/i ) || file.name.match( /\.mov/i )) && !free_period) { %}
	<li class="show_popup">
	{% if (file.url) { %}
		<img class="video_pleer" href="{%=file.url%}" real_width="0" real_height="0" file_name="{%=file.name%}" uniq_name="{%=file.name%}-{%=i%}" src="<?=SITE_TEMPLATE_PATH?>/img/video_camera.png">
	{% } %}
	</li>
	{% } %}
{% } %}
</script>

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/vendor/jquery.ui.widget.js"></script>

<!-- The Templates plugin is included to render the upload/download listings -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/tmpl.min.js"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/load-image.min.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/canvas-to-blob.min.js"></script>

<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/bootstrap.min.js"></script>

<!-- blueimp Gallery script -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.blueimp-gallery.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.iframe-transport.js"></script>

<!-- The basic File Upload plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload.js"></script>

<!-- The File Upload processing plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-process.js"></script>

<!-- The File Upload image preview & resize plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-image.js"></script>

<!-- The File Upload audio preview plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-audio.js"></script>

<!-- The File Upload video preview plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-video.js"></script>

<!-- The File Upload validation plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-validate.js"></script>

<!-- The File Upload user interface plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-ui.js"></script>

<!-- The main application script -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/main.js?05042015"></script>


<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->

<!--[if (gte IE 8)&(lt IE 10)]>

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/cors/jquery.xdr-transport.js"></script>

<![endif]-->


<style>
	.template-video iframe{
		width: 100%;
	}
	li.show_popup:nth-child(n+<?=sizeof($arResult["PHOTO"])+1;?>) {
		opacity: 0.3 !important;
	}
<style>
