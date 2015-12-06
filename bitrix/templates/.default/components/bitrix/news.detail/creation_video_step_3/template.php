<div style="min-height:300px">
<?
if(!$arResult["ID"]){
	exit();
}

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

$arFilter = Array(
   "IBLOCK_ID"=>"30", 
   "ACTIVE"=>"Y", 
   "ID"=>$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']
   );
$arSelect = array("PROPERTY_PHOTO","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$photo_value;
if($ar_fields = $res->GetNext()){
	$photo_value = $ar_fields["PROPERTY_PHOTO_VALUE"];
}
//выбор фотографий для данного клипа
$arFilter = Array(
   "IBLOCK_ID"=>"31", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>$photo_value
   );
$arSelect = array("PROPERTY_SIZE","PROPERTY_SECOND","PROPERTY_NO_VIDEO","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$photo = array();
while($ar_fields = $res->GetNext())
{
  $photo[] = $ar_fields;
}




$clip_id = $arResult["ID"];
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
</div>
<div class="popup">
</div>
<div class="popup" style="position: absolute; z-index: 999; background: transparent none repeat scroll 0% 0%; width: 120%; left: -10%;">
	<div class="popup-container with_border" style="margin: 0 auto 0; top: 20px; width: 100%;">
		<div class="wait popup-wait" style="text-align: center; padding: 40px 70px;">
			<form enctype="multipart/form-data" method="POST" action="/ajax/upload.php" id="fileupload" class="">
				<div class="upload-wrap">
				</div>
				<div class="table table-striped imgs_uploader" role="presentation">
					<ul class="upload-table files ui-sortable not_sortable">
				  
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
								<li class="show_popup in">   
									<span class="preview">  								
										<img 
											src="<?=$path_to_dir.$num.'_.jpg';?>" 
											uniq_name="<?=$num.'_.jpg';?>" 
											file_name="<?=$num.'_.jpg';?>" 
											real_height="<?=$h_i ? $h_i : "720"?>" 
											real_width="<?=$w_i ? $w_i : "1280"?>" 
											href="<?=$path_to_dir.trim($contents_img[$photo_n]);?>" 
											id="img_n-<?=$photo_n; ?>"
										/>
									</span>
								</li>
						<? endforeach;?>
					</ul>
				</div>
			</form>
		
			<div class="content-title bold-title" style="text-decoration: uppercase; color: #5d7395; font-family: 'One_Days'; font-weight: normal; line-height: 25px; font-size: 14px;">
				<span style="color:red">Внимание!</span> проверьте, правильно ли мы обрезали ваши фото? <br />
				если нет - то кликните на кривое фото
				<br /><br />
			</div>
			<div>
				<a class="button-slide" href="/fljvrFG/" id="go_next" style="width: 310px; text-transform: uppercase; font-size: 12px; height: 35px; line-height: 35px;">
					Теперь все правильно, дальше
				</a>
			</div>
			<div style="font-family: arial, sans-serif; font-size: 11px">Нажимая "дальше", Вы принимаете условия <a href="/viewDoc/" target="_blank" style="color:blue">Пользовательского соглашения</a></div>
		</div>
	</div>
</div>
<div id="preview_popup_full" class="no_hide_after_order">
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
    	<a class="btn_go save_and_go button-slide" href="#">Сохранить и продолжить</a>
        <!--<a class="btn_go delete_this_photo" href="#"><?=GetMessage("S_DELETE_THIS_PHOTO");?></a>-->
    </div>
</div>

<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/jquery-cropbox-master/jquery.cropbox.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script>

	$('.show_popup img').not('.check').click(function(e) {
		
		if($(this).attr("src") == ''){
			return false;
		}
		
		sel_img = $(this);
			
		var myregexp    = /img_n-([0-9]+)/i;
		var match       = myregexp.exec(sel_img.attr('id'));
		var img_id 		= parseInt( match[1] );
	
		if(img_id>(count_pictures-1)){
			return false;
		}
		
		
		if(sel_img.hasClass("ui-selected")){
			if(!e.ctrlKey) {
				$('.show_popup img').not('.check').each(function(index, element) {
					$(this).removeClass("ui-selected");
				});
			}else{
				sel_img.removeClass("ui-selected");
			}
		}else{
			if(!e.ctrlKey) {
				$('.show_popup img').not('.check').each(function(index, element) {
					$(this).removeClass("ui-selected");
				});
			}

			sel_img.addClass("ui-selected");
			$('.delete.silver_btn').addClass('active_silver');
			
			if(!e.ctrlKey) {
				
		
				k = 0;
				$('.show_popup img').not('.check').each(function(index, element) {
					if(sel_img.attr("uniq_name") == $(this).attr("uniq_name")){
						return false;
					}
					k++;
				});
		
				for(i = 0; i<=120000; i++){
					if(settings[i] && settings[i][0] == k){
						num = i;
						sec = settings[i][1];
						break;
					}
				}
				//video.currentTime = sec/25;
				
				console.log(num);
				change_photo(true);
			}
		}
		$('.popup_video_work_station, #preview_popup_full').show();
		check_pp = 1;
		//settings
		
	});
	
	//[x1,x2,y1,y2,w,h,real_w,real_h,factor]

	var coords = [];

	//[num,sec,width,height,width_jcrop,height_jcrop]

	var settings = [];

	<?
		$work_area_whidth = 519;
		$work_area_height = 290;	
	?>

	<?
	//если есть координаты то их берем из файла
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'data.txt';
		$arData = unserialize($APPLICATION->GetFileContent($uploaddir));
	?>			
	
	var work_area_whidth = 519;
	var work_area_height = 290;

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
		
		<?

			while($size[0]>$work_area_whidth || $size[1]>$work_area_height){
				$del = 1;
				if($size[0]>$work_area_whidth){
					$del = $work_area_whidth/$size[0];
					$size[0] = $work_area_whidth;
					$size[1] = floor($size[1]*$del);
				}
				elseif($size[1]>$work_area_height){
					$del = $work_area_height/$size[1];
					$size[1] = $work_area_height;
					$size[0] = floor($size[0]*$del);	
				}
			}
			
			

			
			/*while($size[0]>$work_area_whidth){
				$del = $work_area_whidth/$size[0];
				$size[0] = $work_area_whidth;
				$size[1] = floor($size[1]*$del);
			}*/
		
		?>

		<?if(is_array($arData[$k])):?>
			<?if(intval($arData[$k]['width']) != intval($real_size[0]) || intval($arData[$k]['height']) != intval($real_size[1])):?>
				coords.push([0,0,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1,0,""]);
			<?else:?>
				coords.push([<?=trim(intval($arData[$k]['x1']));?>,<?=trim(intval($arData[$k]['x2']));?>,<?=trim(intval($arData[$k]['y1']));?>,<?=trim(intval($arData[$k]['y2']));?>,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1,0,<?=trim(intval($arData[$k]['file']));?>]);
			<?endif;?>		
		<?else:?>
			coords.push([0,0,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1,0,""]);
		<?endif;?>		

		<? for($i=trim($time[0]);$i<trim($time[1]);$i++):?>

			settings.push([<?=$k;?>,<?=$i;?>,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=$no_video;?>]);

		<? endfor;?>

	<? endforeach; ?>

	

	var count = <?=sizeof($photo)?>;

	var num = 0;

	var sec = -1;

	var num_text = 0;

	

	var timer;

	var timer_s; 

	var timer_text;
	
	var count_pictures = '<?=sizeof($photo); ?>';
	var check_popup = 0;
	
	function change_photo(once) { 
		if(settings.length >= (num+1)){
			if(answ = show_photo(num)){
				if(answ != 'no_increment'){
					num++;
				}
				if(!once){
    				timer = setTimeout(change_photo, time_change);
				}
			}
		}else{
			stop_p(true);
		}
 	}
	var alr_curr = -1;
	var show_array = new Array();
	function show_photo(numbr){
		
		cur_picture = settings[numbr][0];
		
		if(alr_curr != cur_picture){
			$('.show_img').hide();
			$('.min_size').hide();
			alr_curr = cur_picture;
			$('.files .show_popup img').not('.check').removeClass("ui-selected");
		}

		if(settings[numbr][1] != sec){
			return 'no_increment';
		}

		
		if(!$("#fileupload .show_popup").eq(cur_picture).length){
			return false;
		}

		

		tr_need = $("#fileupload .show_popup").eq(cur_picture);

		src = $(".preview img",tr_need).not('.check').attr('href');
		
		if($('.clip_num_'+cur_picture).length && $('.clip_num_'+cur_picture).hasClass('video_pleer_img_clips')){
			$('.clip_num_'+cur_picture).remove();
		}
		
		
		$('.error_size').html('');
		
		if($(".preview img",tr_need).not('.check').hasClass('video_pleer')){
			if(settings[numbr][6] == 1){
				$('.error_size').html('<?=GetMessage("S_NO_VIDEO")?>');
			}
			
			if($('.clip_num_'+cur_picture).length){
				$('.clip_num_'+cur_picture).remove();
			}
			img_clips = '<div class="show_img img_clips video_pleer_img_clips clip_num_'+cur_picture+'"><iframe scrolling="no" frameborder="0" style="height:294px; width:522px;" src="/ajax/preview_video.php?file_name='+$(".preview img",tr_need).not('.check').attr("file_name")+'"></iframe></div>';
			$('.img_block .clip_imgs').append(img_clips);
			
			$('.files .show_popup img').not('.check').each(function(index, element) {
            	if($(this).attr('uniq_name') == $('img',$("#fileupload .show_popup").eq(cur_picture)).attr('uniq_name')){
					$(this).addClass("ui-selected");
				}
       		});
			
			$('.next_prev_img .text_scrl').hide();
			$('.next_prev_img .video_scrl').show();
			
			num_next_prev = cur_picture;
			change_prev_next_pictr();
			
			$('.clip_num_'+cur_picture).show();
			return true;
		}else{
			$('.next_prev_img .text_scrl').show();
			$('.next_prev_img .video_scrl').hide();
		}
		
		
		
		if(show_array[cur_picture] && show_array[cur_picture] != src){
			$('.clip_num_'+cur_picture).remove();
		}

		if(!$('.clip_num_'+cur_picture).length){
			
			show_array[cur_picture] = src;

			img_clips = '<div class="show_img img_clips clip_num_'+cur_picture+'"><img id="target_'+numbr+'" src="'+src+'" style="border:none;" /></div>';			

			$('.img_block .clip_imgs').append(img_clips);
			
			width_pict = $(".preview img",tr_need).not('.check').attr('real_width');
			height_pict = $(".preview img",tr_need).not('.check').attr('real_height');
			
			
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
			
			
			new_width_jcrop = settings[numbr][4];
			new_height_jcrop = settings[numbr][5];
			
			if(height_pict < new_height_jcrop){
				del = new_height_jcrop/height_pict;
				height_pict = new_height_jcrop;
				width_pict = Math.floor(width_pict*del);
			}else if(width_pict < new_width_jcrop){
				del = new_width_jcrop/width_pict;
				width_pict = new_width_jcrop;
				height_pict = Math.floor(height_pict*del);
			}		
			
			$('.img_clips.clip_num_'+cur_picture+' img').attr({'height': height_pict, 'width': width_pict});
			
			 $( '.img_clips.clip_num_'+cur_picture ).css({
				"width": width_pict+'px',
				"height": height_pict+'px'
			});
			
			sety = ((height_pict/2 - new_height_jcrop/2)>0)? height_pict/2 - new_height_jcrop/2:0;
			setx = ((width_pict/2 - new_width_jcrop/2)>0)? width_pict/2 - new_width_jcrop/2:0;
			if(coords[cur_picture][0] != 0){
				setx = coords[cur_picture][0]; 
			}
			if(coords[cur_picture][2] != 0){
				sety = coords[cur_picture][2];
			}
			
			paddy = ((work_area_height/2 - new_height_jcrop/2)>0)? work_area_height/2 - new_height_jcrop/2:0;
			paddx = ((work_area_whidth/2 - new_width_jcrop/2)>0)? work_area_whidth/2 - new_width_jcrop/2:0;
			
			$( '.img_clips.clip_num_'+cur_picture ).css({
				"padding-top": paddy+'px',
				"padding-left": paddx+'px'
			});
			
			$('.img_clips.clip_num_'+cur_picture+' img').cropbox({
				width: new_width_jcrop,
      			height: new_height_jcrop,
				img_width: width_pict,
				img_height: height_pict,
				img_left:-setx,
				img_top:-sety,
				showControls: 'never',
				setCrop: {cropX:setx,cropY:sety,cropW:new_width_jcrop,cropH:new_height_jcrop},
				result: {cropX:setx,cropY:sety,cropW:new_width_jcrop,cropH:new_height_jcrop}
    		}).on('cropbox', function(e, data) {
				//num = num-1;
				coords[settings[num][0]][0] = data.cropX;

				coords[settings[num][0]][1] = data.cropW;

				coords[settings[num][0]][2] = data.cropY;

				coords[settings[num][0]][3] = data.cropH;
				
				$("#img_n-"+settings[num][0]).attr('clip_edit', 1);
				coords[settings[num][0]][10] = parseInt($("#img_n-"+settings[num][0]).attr('file_name'));
				if(isNaN(parseInt(coords[settings[num][0]][0])) || isNaN(parseInt(coords[settings[num][0]][2]))){
					$("#img_n-"+settings[num][0]).attr('clip_left', 0);
					$("#img_n-"+settings[num][0]).attr('clip_top', 0);
				}else{
					$("#img_n-"+settings[num][0]).attr('clip_left', coords[settings[num][0]][0]);
					$("#img_n-"+settings[num][0]).attr('clip_top', coords[settings[num][0]][2]);
				}
				
    		});

		}else{
			
			
			width_pict = $(".preview img",tr_need).not('.check').attr('real_width');
			height_pict = $(".preview img",tr_need).not('.check').attr('real_height');
			
			//console.log(width_pict,height_pict);
			
			if(!(work_area_height/height_pict < width_pict>work_area_whidth)){
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

			$('.img_clips.clip_num_'+cur_picture+' img').attr({'height': height_pict, 'width': width_pict});
			
			 $( '.img_clips.clip_num_'+cur_picture ).css({
				"width": width_pict+'px',
				"height": height_pict+'px'
			});

			$('.clip_num_'+cur_picture+' img').attr('src',src);
			
			
			
			$('.clip_num_'+cur_picture+' img.cropImage').attr('src',src);
			
			

		}

		

		$('.clip_num_'+cur_picture).show();

		$('.min_size .size').html(settings[numbr][4]+"X"+settings[numbr][5]);
		
		$('.files .show_popup img').not('.check').each(function(index, element) {
            if($(this).attr('src') == $('.clip_num_'+cur_picture+' img').attr('src')){
				$(this).addClass("ui-selected");
				return true;
			}
        });
		
		num_next_prev = cur_picture;
		change_prev_next_pictr();

		//$('.min_size').show();
		
		if(parseInt(coords[settings[num][0]][6])>parseInt($(".preview img",tr_need).not('.check').attr('real_width')) || parseInt(coords[settings[num][0]][7])>parseInt($(".preview img",tr_need).not('.check').attr('real_height'))){
			//$('.error_size').html('<?=GetMessage("S_WRANG_SIZE")?>'+coords[settings[num][0]][6]+'X'+coords[settings[num][0]][7]+'');
		}else{
			$('.error_size').html('');
		}

		return true;

	}
	function change_prev_next_pictr(){
		$('.num_align_photo').html(num_next_prev+1);		
	}
	$('.save_and_go').click(function(e){
		e.preventDefault();
		$('.popup_video_work_station, #preview_popup_full').hide();
		check_pp = 0;
		
		var num_img = settings[num][0];
		if($('.clip_num_'+num_img+' img').length){
			coords[num_img][9] = parseInt(coords[num_img][6]) / parseInt(coords[num_img][4]);
		}
		if($('.clip_num_'+num_img+' img').length){
			if(coords[num_img]){
				coords[num_img][8] = parseInt($(this).attr("real_height")) / parseInt($('.clip_num_'+num_img+' img').height());
			}else{
				coords[num_img][8] = parseInt($(this).attr("real_height")) / parseInt($('.img_area').height());
			}
		}
		$.post("<?=SITE_DIR?>ajax/save_coords.php", {coords:coords});

		$('#img_n-'+num_img).attr('clip_width', parseInt(coords[num_img][6]));
		$('#img_n-'+num_img).attr('clip_height', parseInt(coords[num_img][7]));

/*		
		$.post("<?=SITE_DIR?>ajax/resize_img_to_change.php", {coords:coords,num_img:num_img,imgs:$('#img_n-'+num_img).attr('href')}, function(data){
			console.log(data);
			//alert(data);
		});
*/
	});
</script>
<style>
	.show_popup.in img {
		height: auto;
	}
</style>