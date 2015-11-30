<?

$tmp = "";

if($_COOKIE['UPLOAD_FILES']){

	$tmp = $_COOKIE['UPLOAD_FILES']."/";

}

?>

<script>

	var er_file_types = '<?=GetMessage("S_ER_FILE_TYPES")?>';

	var er_maxFileSize = '<?=GetMessage("S_MAX_FILE_SIZE")?>';

	var er_minFileSize = '<?=GetMessage("S_MIN_FILE_SIZE")?>';

	var er_maxNumberOfFiles = '<?=GetMessage("S_MAX_NUMBR_FILES")?>';
	
	var free_period = '<? echo ($arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])? '1':'' ?>';
	

</script>





<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.js"></script>



<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.Jcrop.min.js"></script>


<script src="<?=SITE_TEMPLATE_PATH?>/jquery-cropbox-master/jquery.cropbox.js"></script>



<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->

<!--[if (gte IE 8)&(lt IE 10)]>

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/cors/jquery.xdr-transport.js"></script>

<![endif]-->


<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script>  
$('#add_mp3').hover(
	function(){ setTimeout(function(){$('#add_mp3').addClass('active_silver');}, 150); }
) 

$('#add_logo').hover(
	function(){ setTimeout(function(){$('#add_logo').addClass('active_silver');}, 150); }
) 
$('.container').hover(

	function(){ $('#add_mp3, #add_logo').removeClass('active_silver');}
)  

$( ".imgs_uploader2" ).selectable({ 
			filter: "div.img_prev_upl img",
			start: function( event, ui ) {
				clearTimeout(select_first_photo);
			},
			stop: function( event, ui ) {
				select_first_photo = setTimeout(select_first_photo_f, 1000);
			}
});

function select_first_photo_f() { 
	var img_num = 0;
	$('.img_prev_upl').each(function(index, element) {
		img_num++; 
		if(img_num == 1 && !$('.img_prev_upl img.ui-selected').length && $('img',$(this)).length && $('.step_2_station').css('display') != 'none'){
			$('img',$(this)).trigger('click');
		}			
	});
	select_first_photo = setTimeout(select_first_photo_f, 1000);
  }
  
  var select_first_photo = setTimeout(select_first_photo_f, 10000);

</script>


<script> 
$('.img_area').on( "mousedown", "img.cropImage", function(e) {
    pause_p();
});

$('.close_prev_popup').click(function(e) {
	e.preventDefault();
    $('#preview_popup_full, #preview_popup, #preview_popup .preview_popup').hide();
});
if($('.logo_biz #add_logo').length){
	$(function(){

			new AjaxUpload($('.logo_biz #add_logo'),{

				action: '/ajax/upload_logo.php',

				name: 'uploadlogo',

				onSubmit: function(file, ext){

					if(!(ext &&  /^(gif)$|^(jpg)$|^(png)$|^(jpeg)$/.test(ext))){

						alert('<?=GetMessage("S_ONLY_PICTURE")?>');

						return false;

					};

					$('.logo_biz #logo_viz .logo_name').html('<?=GetMessage("S_PROCESSING")?>');

				},

				onComplete: function(file, response){
					$('.logo_biz #logo_viz .logo_name').html('');
					
					if($(response).find('answer').text() == 'ok'){
						
						$('.logo_biz #logo_viz').removeClass('logo_viz_brdr');
						
						$('.logo_biz #logo_viz .logo_img_div').html('<img class="logo_img" style="width:400px; margin: auto; display: block;" src="/upload/tmp/<?=$tmp; ?>' + $(response).find('file').text() +'" />')

					}

					else{

						alert('<?=GetMessage("S_COULD_NOT_LOAD")?>');
						
					};

				}

			});

	});

}



if($('.logo_photograph #add_logo').length){
	$(function(){

			new AjaxUpload($('.logo_photograph #add_logo'),{

				action: '/ajax/upload_photo_logo.php',

				name: 'uploadlogo',

				onSubmit: function(file, ext){

					if(!(ext &&  /^(gif)$|^(jpg)$|^(png)$|^(jpeg)$/.test(ext))){

						alert('<?=GetMessage("S_ONLY_PICTURE")?>');

						return false;

					};

					$('.logo_photograph #logo_viz .logo_name').html('<?=GetMessage("S_PROCESSING")?>');

				},

				onComplete: function(file, response){
					$('.logo_photograph #logo_viz .logo_name').html('');
					
					if($(response).find('answer').text() == 'ok'){
						
						$('.logo_photograph #logo_viz').removeClass('logo_viz_brdr');
						
						$('.logo_photograph #logo_viz .logo_img_div').html('<img class="logo_img" style="width:400px; margin: auto; display: block;" src="/upload/tmp/<?=$tmp; ?>' + $(response).find('file').text() +'" />')
						

					}

					else{

						alert('<?=GetMessage("S_COULD_NOT_LOAD")?>');
						
					};

				}

			});

	});

}


	var num_next_prev = -1;
	
	
	function change_prev_next_pictr(){
		$('.num_align_photo').html(num_next_prev+1);		
	}
	

	$('.next_prev_img .prev_img img').click(function(e) {
        if(num_next_prev>0){
			clearTimeout(select_first_photo);
			num_next_prev--;
			pause_p();
			$('.img_prev_upl img').each(function(index, element) {
				if(index == num_next_prev){
					$(element).trigger('click');
					$(this).trigger('click');
					change_prev_next_pictr();
					select_first_photo = setTimeout(select_first_photo_f, 10000);
					return false;
				}			
			});
			
		}
    });
	
	
	
	$('.next_prev_img .next_img img').click(function(e) {
        if(num_next_prev<(count_pictures-1) && ($('.img_prev_upl img').length-1) > num_next_prev){
			clearTimeout(select_first_photo);
			num_next_prev++;
			pause_p();
			$('.img_prev_upl img').each(function(index, element) {
				
				if(index == num_next_prev){
					$(element).trigger('click');
					$(this).trigger('click');
					change_prev_next_pictr();
					select_first_photo = setTimeout(select_first_photo_f, 10000);
					return false;
				}			
			});
		}
    });
	

	$('.delete.silver_btn').click(function(){
		$(this).removeClass('active_silver'); 
	}); 
	

	$('.img_prev_upl img').click(function(e) {
		
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
				$('.img_prev_upl img').each(function(index, element) {
					$(this).removeClass("ui-selected");
				});
			}else{
				sel_img.removeClass("ui-selected");
			}
		}else{
			if(!e.ctrlKey) {
				$('.img_prev_upl img').each(function(index, element) {
					$(this).removeClass("ui-selected");
				});
			}

			sel_img.addClass("ui-selected");
			$('.delete.silver_btn').addClass('active_silver');
			
			if(!e.ctrlKey) {
				
		
				k = 0;
				$('.img_prev_upl img').each(function(index, element) {
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
				change_photo(true);
			
				
				if($('#audio_player_cl').attr('src') != '')
		audio.currentTime = video.currentTime;
			}
		
		}
		
		$('.popup_video_work_station, #preview_popup_full').show();
		check_pp = 1;
		//settings
		
	});
	
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

//запись текстов
	$("textarea.text_inp").on("focusout", function() {
		var texts = [];
		$("textarea.text_inp").each(function(){
			texts.push($(this).val());
		});
		
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
	});

	$('.delete_this_photo').click(function(e){
		e.preventDefault();
		$('.popup_video_work_station, #preview_popup_full').hide();
		check_pp = 0;
		$('#fileupload .delete').trigger('click');
	});
	
	$('#fileupload .delete').click(function(){
		$('.show_img').hide();
		$('.img_prev_upl img').each(function(index, element) {
            if($(this).hasClass("ui-selected")){
				_this = $(this);
				_this.parents('.img_prev_upl').remove();
				$.ajax({
					url: "/ajax/upload.php" + '?' + $.param({"file": _this.attr("file_name")}),
   					type: 'DELETE'
				}).done(function() {
					
				});
			}
        });
		check_pp = 0;
		check_video_size();
        show_vertical_size();        
	});
	
	$('html').keyup(function(e){
    	if(e.keyCode == 46){
			$('#fileupload .delete').trigger('click');	
		}
	});
	
	$(function(){
		
		

		$("#fileupload .files1").sortable({

	    	opacity: 0.6,
						
			tolerance:'pointer',

	    	start: function(event, ui) {
	    		$('.img_prev_upl img').removeClass('ui-selected');
			},
			
	    	stop: function(event, ui) {

				check_video_size();
				
				var imgs = [];

				$("#fileupload .files .img_prev_upl .preview img").each(function(){

					imgs.push($(this).attr('file_name'));

				});

				$.post("/ajax/resorting.php", {imgs:imgs}, function(responseText){
					//img_nums_res();
				});
				
				
				$('.img_prev_upl img').each(function(index, element) {
                    if($(this).hasClass('ui-selected')){
						$(this).removeClass('ui-selected');
						$(this).trigger('click');
						return false;
					}
                });
				
				//$('.img_block .clip_imgs').html('');

			}

	    });

	});


function img_nums_res(){
	$('.img_prev_upl .num').each(function(index, element) {
		$(this).html('№' + ' ' + (parseInt(index)+1));
	});	
	$("#fileupload .img_prev_upl .preview img").each(function(index, element){
		$(this).attr('id', 'img_n-'+index);
	});
}
</script>









    

    

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/ajaxupload.js"></script>


<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/audiojs/audio.min.js"></script>

<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.screwdefaultbuttonsV2.js"></script>

<?
$arFilter = Array(
	"IBLOCK_ID"=>$arResult['IBLOCK_ID'],
	"!ID"=>$arResult['ID'], 
	"ACTIVE"=>"Y", 
);
$arSelect = array("ID");
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter,false,false,$arSelect);
$clips = array();
$prev = "";
$next = "";
while($ar_fields = $res->GetNext())
{
	$clips[] = $ar_fields;
}

foreach($clips as $ar_fields){
	if($arResult['ID'] < $ar_fields['ID'] && !$next){
		$next = "<div style=\"display:none;\" class=\"next_templ\"><span><a href=\"".SITE_DIR."create_video/?video_id=".$ar_fields['ID']."\">".GetMessage("S_NEXT_TPL")."</a></span></div></a>";
		break;
	}
}

$clips = array_reverse($clips);
foreach($clips as $ar_fields){
	if($arResult['ID'] > $ar_fields['ID'] && !$prev){
		$prev = "<div style=\"display:none;\" class=\"prev_templ\"><span><a href=\"".SITE_DIR."create_video/?video_id=".$ar_fields['ID']."\">".GetMessage("S_PREV_TPL")."</a></span></div>";
		break;
	}
}

if(!$prev){
	$prev = '<div style="float:left; height:130px; width:270px;"></div>';
}


?>

<script>

function rem_err(_this) {
	
	_this.remove();
}

$("#show_how_clip_btn").click(function(e){
	e.preventDefault();
	$('#preview_popup_full, #preview_popup, #preview_popup .preview_popup').hide();	
	$('#preview_popup_full, #preview_popup, #preview_popup #text_explain').show();	
})

check_first_load = true;
  
time_change = 40;
var video_cost = '<? echo ($arResult['PROPERTIES']['VIDEO_COST']['VALUE'] || $arResult['PROPERTIES']['VIDEO_COST']['VALUE'] === '0')? trim($arResult['PROPERTIES']['VIDEO_COST']['VALUE']): "100"; ?>';
var count_pictures = '<?=sizeof($photo); ?>';
var check_popup = 0;
var timer_change_count_text_photo = setTimeout(function change_count_text_photo() {
	if($('.show_hide_photogr_logo .logo_img_div img').length){
		$('.show_hide_photogr_logo #add_logo').val('<?=GetMessage("S_CHANGE")?>');
	}else{
		$('.show_hide_photogr_logo #add_logo').val('<?=GetMessage("S_ADD")?>');
	}
	
	$('.img_prev_upl').each(function(index, element) {
		
		if($('.error',$(this)).length && $.trim($('.error',$(this)).html())){
			setTimeout(rem_err, 4000, $(this));
		}
	});
	
	
	var dop_cost = 0;
	var _calc_html = '<li><?=GetMessage("S_CREATE_CLIP")?> <span class="blue">'+$('.cost_m').attr('real_cost')+' <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?></span></li>';
	var _calc_video_html = '';
	$('.img_prev_upl .video_pleer').each(function(index, element) {
		if(parseInt($(this).parent().parent('.img_prev_upl').css('opacity')) > 0.3){
			if(video_cost != '0'){
				dop_cost += parseInt(video_cost);
				_calc_video_html = _calc_video_html + '<li><?=GetMessage("S_PLUS_VIDEO")?> '+ $('.num',$(this).parent('.preview')).html()+' <?=GetMessage("S_INST_VIDEO")?> <span class="blue">'+video_cost+' <?=$arResult['PROPERTIES']['CURRENCY']['VALUE']?></span></li>';
			}
		}
	});


	if($('#no_logo').is(':checked')){
		//$('.show_hide_photogr_logo').show();
		$('.cost_m').html(parseInt($('.cost_m').attr('plus_cost')) + dop_cost);
		_calc_html = _calc_html + '<li><?=GetMessage("S_WITHOUT_LOGO")?> <span class="blue"><?=$logo_sett['PROPERTY_LOGO_COST_VALUE'];?> <?=$arResult['PROPERTIES']['CURRENCY']['VALUE'];?></span></li>';
	}else{
		$('.cost_m').html(parseInt($('.cost_m').attr('real_cost')) + dop_cost);
		$('.show_hide_photogr_logo').hide();
	}
	
	_calc_html = _calc_html + _calc_video_html;
	
	$('.rasch_cost ul').html(_calc_html);
		
	img_nums_res();
	
	if(check_first_load){
		$("#fileupload .img_prev_upl .preview img").each(function(index, element){
			if(!$(this).hasClass('video_pleer') && coords[index]){
				$(this).attr('clip_width', parseInt(coords[index][6]));
				$(this).attr('clip_height', parseInt(coords[index][7]));
				$(this).attr('clip_left', parseInt(coords[index][0]));
				$(this).attr('clip_top', parseInt(coords[index][2]));
				if(parseInt($(this).attr('file_name')) == coords[index][10]){
					if(coords[index][0] != 0 || coords[index][1] != 0 || coords[index][2] != 0 || coords[index][3] != 0){
						$(this).attr('clip_edit', 1);
						coords[index][10] = parseInt($(this).attr('file_name'));
					}
				}else{
					$(this).attr('clip_left', 0);
					$(this).attr('clip_top', 0);
					coords[index][0] = 0;
					coords[index][2] = 0;
				}
			}
		});
		check_first_load = false;
	}
	
	difference = parseInt(count_pictures) - parseInt($('.img_prev_upl .preview img').length);
	if(difference > 0){
		$('#count_pictures_container span.blue').html(" ЕЩЁ "+difference+" ФОТО ");
		$('#count_pictures_container').show();
		$('#all_pictures_container').hide();
		$('.step_2_station, .footer-wrapper').hide();
		$('.new_video_maket').css('margin-left','310px');
		$('.error_vertical').hide();
	}else{
		//if($('#preview_popup').length && check_popup == 0){
			//$('#preview_popup_full, #preview_popup, #preview_popup #text_explain').show();
			//check_popup++;
		//}
		
		$('#count_pictures_container').hide();
		$('#all_pictures_container').show();
		$('.step_2_station, .footer-wrapper').show();
		$('.new_video_maket').css('margin-left','0px');
		show_vertical_size();
		show_ret_mp3();
	}
	if(parseInt($('.img_prev_upl .preview img').length)<=0 || !$('.img_area .show_img:visible').length){
		$('.num_align_photo').html('');
		var num_next_prev = -1;
	}
	
    timer_change_count_text_photo = setTimeout(change_count_text_photo, 1000);
  }, 1000);
  
  
  
function show_ret_mp3(){
	if($('#path_to_return_mp3').attr('mp3_name') != $('.audio_name .mp3_name').text() && $('.audio_name .mp3_name').text() !='<?=GetMessage("S_PROCESSING")?>'){
		$('#return_mp3').show();
	}else{
		$('#return_mp3').hide();
	}
}

check_pp = 0; //для проверки, открыто ли окно уже


//функция отслеживания измения размеров видео формата
function check_video_size(){

	$("#fileupload .img_prev_upl .preview img").each(function(index, element){
		$(this).attr('id', 'img_n-'+index);
	});

	for(i = 0; i < count_pictures ; i++){
		elem = $('#img_n-'+i);
		if(elem.length){
			if(coords[i]){
				if((coords[i][6] != parseInt(elem.attr('clip_width'))) || (coords[i][7] != parseInt(elem.attr('clip_height'))) || ($(this).attr('uniq_name') != coords[index][10])){
					$('.clip_num_'+i).remove();
					elem.attr('clip_width', coords[i][6]);
					elem.attr('clip_height', coords[i][7]);
					elem.attr('clip_edit', 0);
					coords[i][0] = 0;
					coords[i][1] = 0;
					coords[i][2] = 0;
					coords[i][3] = 0;
					coords[i][8] = 1;
				}else{
					coords[i][0] = parseInt(elem.attr('clip_left'));
					coords[i][2] = parseInt(elem.attr('clip_top'));
				}
			}else{
				coords[i][0] = parseInt(elem.attr('clip_left'));
				coords[i][2] = parseInt(elem.attr('clip_top'));
			}
		}else{
			$('.clip_num_'+i).remove();
			coords[i][0] = 0;
			coords[i][1] = 0;
			coords[i][2] = 0;
			coords[i][3] = 0;
			coords[i][8] = 1;
		}
	};
	
	$.post("<?=SITE_DIR?>ajax/save_coords.php", {coords:coords});
}


function show_vertical_size(){
	return false;
	n_wrang_picture = [];
	$("#fileupload .img_prev_upl .preview img").each(function(index, element){
		if(!$(this).hasClass('video_pleer') && coords[index]){
			n_work_area_whidth = parseInt(coords[index][6]);
			n_work_area_height = parseInt(coords[index][7]);
			n_new_width = parseInt($(this).attr('real_width'));
			n_new_height = parseInt($(this).attr('real_height'));
			if(!(n_work_area_height/n_new_height < n_work_area_whidth/n_new_width)){
				while(n_new_height>n_work_area_height || n_new_height<n_work_area_height){
					n_del = n_work_area_height/n_new_height;
					n_new_height = n_work_area_height;
					n_new_width = Math.floor(n_new_width*n_del);	
				}
			}else{
				while(n_new_width>n_work_area_whidth || n_new_width<n_work_area_whidth){
					n_del = n_work_area_whidth/n_new_width;
					n_new_width = n_work_area_whidth;
					n_new_height = Math.floor(n_new_height*n_del);	
				}
			}
			
			if(((n_new_height/n_work_area_height) > 1.2 || (n_new_width/n_work_area_whidth) > 1.2) && parseInt($(this).attr('clip_edit')) != 1){
				//n_wrang_picture.push(index+1);
				if(!check_pp || !$('.popup_video_work_station, #preview_popup_full').is(':visible')){
					$(this).trigger('click');
					check_pp = 1;	
				}
				$(this).addClass('ui-selected_wrang');
			}else{
				$(this).removeClass('ui-selected_wrang');
			}
		}
	});
	
	if(n_wrang_picture.length){
		//console.log(n_wrang_picture);
		$('.error_vertical .error_text').html("Поправьте фото " + n_wrang_picture.join(',') + " и Ваше видео станет гораздо лучше<br />");
		$('.error_vertical').show();
	}else{
		$('.error_vertical').hide();
		$('.error_vertical_aj').hide();
	}
			
} 
  

  
_html = '<div class="name_block"><?=$prev;?><div class="clip_name"><div class="inner_bl_name"><h1><?=$arResult['NAME'];?></h1></div></div><?=$next;?></div>';
$('.navbar-title').html(_html);

$('.next_templ, .prev_templ').click(function(){
	window.location = $('a',$(this)).attr('href');	
})

$('#no_logo').screwDefaultButtons({
	image: 'url("<?=SITE_TEMPLATE_PATH?>/images/checkboxSmall.jpg")',
	width: 51,
	height: 51
});




$( ".volume-container .volume div" ).mouseover(function() {
	var styles = {
		"height" : "22px",
		"margin-top": "-5px"
	};
	$( this ).css( styles );
});

$( ".volume-container .volume div" ).mouseout(function() {
	var styles = {
		"height" : "17px",
		"margin-top": "0px"
	};
	$( this ).animate( styles, 300 );
});
var controls = {
		total: $(".synchronization .total"),
		buffered: $(".synchronization .buffered"),
		progress: $(".synchronization .current"),
		duration: $(".time_sinc .time .duration"),
  		currentTime: $(".time_sinc .time .currenttime"),
		
		total_v: $("#video_controls .total"),
		buffered_v: $("#video_controls .buffered"),
		progress_v: $("#video_controls .current"),
		duration_v: $("#video_controls .duration"),
  		currentTime_v: $("#video_controls .currenttime"),
		
		fullscreen: $(".full_screen"),
		play: $("a.start"),
		pause: $("a.pause"),
		volume_on: $('.volume_on'),
		volume_off: $('.volume_off'),
		progress_volume: $('.synchronization .progress_volume'),
		progress_img: $('.synchronization .progress_volume img'),
		progress_volume_v: $('#video_controls .progress_volume'),
		progress_img_v: $('#video_controls .progress_volume img'),
		volume_pl: $('.volume-container .volume div'),
		hasHours: false
	};

	//audiojs.events.ready(function() {

		//audiojs.createAll();

	//});
	
	$('#return_mp3').click(function(e) {
		_path = $('#path_to_return_mp3').attr('path');
		_mp3_name = $('#path_to_return_mp3').attr('mp3_name');

		$('#audio_player_cl').attr('src',_path);
		$('#path_to_mp3').attr('path',_path);
						
		$('#mp3_viz .mp3_name').html(_mp3_name);

		//audiojs.events.ready(function() {
			//audiojs.createAll();
		//});
		
		if(controls.play.css('display') == 'none'){
			setTimeout(function(){audio.play();}, 1000);
		}
    });

	$(function(){

			new AjaxUpload($('#add_mp3'),{

				action: '/ajax/upload_mp3.php',

				name: 'uploadmp3',

				onSubmit: function(file, ext){

					if(!(ext &&  /^(mp3)$/.test(ext))){

						alert('<?=GetMessage("S_ONLY_MP3")?>');

						return false;

					};

					$('#mp3_viz .mp3_name').html('<?=GetMessage("S_PROCESSING")?>');

				},

				onComplete: function(file, response){

					//$('#audio_player').html('');
					//alert(response);

					if($(response).find('answer').text() == 'ok'){
						
						//audio.pause();
						//$('#audio_player_cl').attr('src', '');
						
						$('#audio_player_cl').attr('src','/upload/tmp/<?=$tmp; ?>' + $(response).find('file').text());

						$('#path_to_mp3').attr('path','/upload/tmp/<?=$tmp; ?>' + $(response).find('file').text());
						
						$('#mp3_viz .mp3_name').html(file);

						//audiojs.events.ready(function() {

        					//audiojs.createAll();
							//audio.load();
							if(controls.play.css('display') == 'none'){
								setTimeout(function(){
									audio.play();									
								}, 1000);
							}

      					//});

					}

					else{

						alert('<?=GetMessage("S_COULD_NOT_LOAD")?>');
						
						
						$('#return_mp3').trigger('click');
						
						//$('#mp3_viz .mp3_name').html("");

					};

				}

			});

	});
	
	//setcookie("PAID_LIMIT",'',-1);
	//setcookie("FREE_LIMIT",'',-1);
	
	$('.check_before_submit').click(function(e){
		e.preventDefault();		

		$("#answer").html('<?=GetMessage("S_PROCESSING")?>');

		$(".order_clip_btn").hide();

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

		$("#fileupload .img_prev_upl .preview img").each(function(index, element){
			//coords[index][10] = settings[index][6];
			var _attr = 'src';
			if($('.clip_num_'+index+' img').length){
				coords[index][9] = parseInt(coords[index][6]) / parseInt(coords[index][4]);
				check_work++;
				_attr = 'href';
			}
			if($('.clip_num_'+index+' img').length){
				if(coords[index]){
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($('.clip_num_'+index+' img').height());
			}else{
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($('.img_area').height());
			}
			}
			imgs.push($(this).attr(_attr));

		});
		
		var texts = [];

		$("textarea.text_inp").each(function(){

			texts.push($(this).val());

		});
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
		
		
		var no_logo = ($('#no_logo').is(":checked"))? 1:0;
		
		$.post("<?=SITE_DIR?>ajax/check_before_create.php", {free_period:free_period,SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>', coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_vk").val(), email_vk:$("#email_vk").val(), name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), vk:1, video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', user_logo:user_logo, user_width:user_width, user_logo_src:user_logo_src, ph_user_logo:ph_user_logo, ph_user_width:ph_user_width, ph_user_logo_src:ph_user_logo_src, section_text_id:"<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>"}, function(data){

			if(data == 1){
				$('.a_order_clip_btn_vk').trigger('click');
			}else{

				$("#answer").html(data);
				$(".order_clip_btn").show();

			}
		});
	});
	
	$("#order_clip_btn, .a_order_clip_btn_vk, .a_order_clip_btn_ok, .a_order_clip_btn_fb").click(function(e){

		e.preventDefault();		

		$("#answer").html('<?=GetMessage("S_PROCESSING")?>');

		$("#order_clip_btn").hide();

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

		$("#fileupload .img_prev_upl .preview img").each(function(index, element){
			//coords[index][10] = settings[index][6];
			var _attr = 'src';
			if($('.clip_num_'+index+' img').length){
				coords[index][9] = parseInt(coords[index][6]) / parseInt(coords[index][4]);
				check_work++;
				_attr = 'href';
			}
			if($('.clip_num_'+index+' img').length){
				if(coords[index]){
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($('.clip_num_'+index+' img').height());
			}else{
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($('.img_area').height());
			}
			}
			imgs.push($(this).attr(_attr));

		});
				
		
		//if(check_work < 2){
			//$("#answer").html('<div class="errors"><?=GetMessage("S_NOT_WORK")?></div>');
			//$("#order_clip_btn").show();
			//return false;
		//}

		

		var texts = [];

		$("textarea.text_inp").each(function(){

			texts.push($(this).val());

		});
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
		
		
		var no_logo = ($('#no_logo').is(":checked"))? 1:0;
		
		
		$.post("<?=SITE_DIR?>ajax/create_clip.php", {free_period:free_period,SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>', coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_vk").val(), email_vk:$("#email_vk").val(), name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), vk:1, video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', user_logo:user_logo, user_width:user_width, user_logo_src:user_logo_src, ph_user_logo:ph_user_logo, ph_user_width:ph_user_width, ph_user_logo_src:ph_user_logo_src, section_text_id:"<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>"}, function(data){

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
				
								
				$.post("<?=SITE_DIR?>ajax/create_clip2.php", {free_period:free_period, coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_feed").val(), vk:1, email_vk:$("#email_vk").val(),  name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', user_logo:user_logo, user_width:user_width, user_logo_src:user_logo_src, ph_user_logo:ph_user_logo, ph_user_width:ph_user_width, ph_user_logo_src:ph_user_logo_src}, function(data){
					setTimeout(function(){window.location = '/fljvrFG/?check=1';}, 1000);
						
				});
				//_html = "<div class='container'><div class='row'><h1 style='text-align:center'><?=GetMessage("S_ORDERED_CLIP")?></h1></div></div>";
				//clearTimeout(timer_change_count_text_photo);
				//$(".main div.hide_after_order").hide();
				//$(".main").append(_html);
				//$('#preview_popup_full, #preview_popup, #preview_popup #text_after_order').show();

				//$("#order_form")[0].reset();

				//$('.files.ui-sortable').html('');

				//$("textarea.text_inp").each(function(){

					//$(this).val('');

				//});

				//$('#mp3_viz').html('');

				//$('#path_to_mp3').attr('path','');

				//$('.img_block .clip_imgs').html('');

			}else{

				$("#answer").html(data);
				$("#order_clip_btn").show();

			}

			

		});
	})



	$("#create").click(function(){

		var imgs = [];

		$("#fileupload .files tr .preview a").each(function(){

			imgs.push($(this).attr('title'));

		});

		$.post("<?=SITE_DIR?>ajax/action_crop.php", {coords:coords,imgs:imgs}, function(responseText){

			$('#create_show').html(responseText);

		});

	});



	$(".text_inp").keyup(function(){

		size_value = parseInt($(this).attr('size_value'));

        if($(this).val().length > size_value && size_value > 0){

        	$(this).val($(this).val().substr(0, size_value));

        }
		
		count_simbols = parseInt(size_value) - parseInt($(this).val().length);
		$('.count_text_value', $(this).parent().parent()).html(count_simbols);

	});

	

	//[num,sec]

	var text_settings = [];

	<? if($texts): ?>

	<? foreach($texts as $k=>$v):?>

		<? $time = explode("-",$v['PROPERTY_SECOND_VALUE']); ?>

		<? for($i=trim($time[0]);$i<trim($time[1]);$i++):?>

			text_settings.push([<?=$k;?>,<?=$i;?>]);

		<? endfor;?>

	<? endforeach; ?>

	<? endif; ?>







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

	

	function change_text(){

		if(text_settings.length >= (num_text+1)){

			if(answ = show_text(num_text)){

				if(answ != 'no_increment'){

					num_text++;

				}

    			timer_text = setTimeout(change_text, time_change);

			}

		}else{

			$('.show_text').html('');

			$('.show_text').hide();

			num_text = 0;

		}



	}

	

	function show_text(numbr){

		$('.show_text').html('');

		$('.show_text').hide();

		if(text_settings[numbr][1] != sec){

			return 'no_increment';

		}

		

		_this_text = $('.text_show_'+text_settings[numbr][0]);

		$('.show_text').html(_this_text.val());

		//$('.show_text').show();

		return true;

	}

	

	function passed_time(){

		//sec++;

		//$('#time_time').html(sec);

		//timer_s = setTimeout(passed_time, time_change);

	}

	

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
			$('.files .img_prev_upl img').removeClass("ui-selected");
		}

		

	
		//alert(settings[numbr][1] +'-'+ sec);

		if(settings[numbr][1] != sec){
			//$('.show_img').hide();
			return 'no_increment';

		}

		
		if(!$("#fileupload .img_prev_upl").eq(cur_picture).length){

			//alert(count+" <?=GetMessage("S_COUNT_PHOTOS")?>");	

			//stop_p(true);

			return false;

		}

		

		tr_need = $("#fileupload .img_prev_upl").eq(cur_picture);

		src = $(".preview img",tr_need).attr('href');
		
		if($('.clip_num_'+cur_picture).length && $('.clip_num_'+cur_picture).hasClass('video_pleer_img_clips')){
			$('.clip_num_'+cur_picture).remove();
		}
		
		
		$('.error_size').html('');
		
		if($(".preview img",tr_need).hasClass('video_pleer')){
			if(settings[numbr][6] == 1){
				$('.error_size').html('<?=GetMessage("S_NO_VIDEO")?>');
			}
			
			if($('.clip_num_'+cur_picture).length){
				$('.clip_num_'+cur_picture).remove();
			}
			img_clips = '<div class="show_img img_clips video_pleer_img_clips clip_num_'+cur_picture+'"><iframe scrolling="no" frameborder="0" style="height:294px; width:522px;" src="/ajax/preview_video.php?file_name='+$(".preview img",tr_need).attr("file_name")+'"></iframe></div>';
			$('.img_block .clip_imgs').append(img_clips);
			
			$('.files .img_prev_upl img').each(function(index, element) {
            	if($(this).attr('uniq_name') == $('img',$("#fileupload .img_prev_upl").eq(cur_picture)).attr('uniq_name')){
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
			
			

			

			//width = settings[numbr][1] ? 'width="'+settings[numbr][2]+'px;"':'';

			//height = settings[numbr][2] ? 'height="'+settings[numbr][3]+'px;"':'';

			

			

			

		

			img_clips = '<div class="show_img img_clips clip_num_'+cur_picture+'"><img id="target_'+numbr+'" src="'+src+'" style="border:none;" /></div>';
			
			
			

			

			

			$('.img_block .clip_imgs').append(img_clips);
			
			width_pict = $(".preview img",tr_need).attr('real_width');
			height_pict = $(".preview img",tr_need).attr('real_height');
			
			
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
			
			
			/*if(width_pict/settings[numbr][4] == height_pict/settings[numbr][5]){
				width_pict = settings[numbr][4];
				height_pict = settings[numbr][5];
			}
			else if(width_pict>work_area_whidth){
				del = work_area_whidth/width_pict;
				width_pict = work_area_whidth;
				height_pict = Math.floor(height_pict*del);	
				
			}*/
			
			
			$('.img_clips.clip_num_'+cur_picture+' img').attr({'height': height_pict, 'width': width_pict});
			
			 $( '.img_clips.clip_num_'+cur_picture ).css({
				"width": width_pict+'px',
				"height": height_pict+'px'
			});
			
			
			/*while(new_width_jcrop>width_pict || new_height_jcrop>height_pict){
				del = 1;
				if(new_width_jcrop>width_pict){
					del = width_pict/new_width_jcrop;
					new_width_jcrop = width_pict;
					new_height_jcrop = Math.floor(new_height_jcrop*del);
				}
				else if(new_height_jcrop>height_pict){
					del = height_pict/new_height_jcrop;
					new_height_jcrop = height_pict;
					new_width_jcrop = floor(new_width_jcrop*del);	
				}
			}*/
			
			sety = ((height_pict/2 - new_height_jcrop/2)>0)? height_pict/2 - new_height_jcrop/2:0;
			setx = ((width_pict/2 - new_width_jcrop/2)>0)? width_pict/2 - new_width_jcrop/2:0;
			if(coords[cur_picture][0] != 0){
				setx = coords[cur_picture][0]; 
				//alert(setx);
				//alert(width_pict);
			}
			if(coords[cur_picture][2] != 0){
				sety = coords[cur_picture][2];
				//alert(sety);
				//alert(height_pict);
			}else{ 
				//sety = 0;
			}
			
			paddy = ((work_area_height/2 - new_height_jcrop/2)>0)? work_area_height/2 - new_height_jcrop/2:0;
			paddx = ((work_area_whidth/2 - new_width_jcrop/2)>0)? work_area_whidth/2 - new_width_jcrop/2:0;
			
			console.log(setx+'-->'+sety);
			
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
			

		


			/*$('#target_'+numbr).Jcrop({	

				setSelect: [setx,sety,new_width_jcrop,new_height_jcrop],	

				minSize: [ new_width_jcrop, new_height_jcrop],

				maxSize: [ new_width_jcrop, new_height_jcrop],

				onChange:   showCoords,
				
				bgOpacity:   0,

				onSelect:   showCoords

			},function(){		

				jcrop_api = this;		

			});*/

		}else{
			
			
			width_pict = $(".preview img",tr_need).attr('real_width');
			height_pict = $(".preview img",tr_need).attr('real_height');
			
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
		
		$('.files .img_prev_upl img').each(function(index, element) {
            if($(this).attr('src') == $('.clip_num_'+cur_picture+' img').attr('src')){
				$(this).addClass("ui-selected");
				return true;
			}
        });
		
		num_next_prev = cur_picture;
		change_prev_next_pictr();

		//$('.min_size').show();
		
		if(parseInt(coords[settings[num][0]][6])>parseInt($(".preview img",tr_need).attr('real_width')) || parseInt(coords[settings[num][0]][7])>parseInt($(".preview img",tr_need).attr('real_height'))){
			//$('.error_size').html('<?=GetMessage("S_WRANG_SIZE")?>'+coords[settings[num][0]][6]+'X'+coords[settings[num][0]][7]+'');
		}else{
			$('.error_size').html('');
		}

		return true;

	}


	

	

	function showCoords(c){

		x1 = c.x; $('#x1').val(c.x);		

		y1 = c.y; $('#y1').val(c.y);		

		x2 = c.x2; $('#x2').val(c.x2);		

		y2 = c.y2; $('#y2').val(c.y2);

		

		$('#w').val(c.w);

		$('#h').val(c.h);

		

		

		coords[settings[num][0]][0] = x1;

		coords[settings[num][0]][1] = x2;

		coords[settings[num][0]][2] = y1;

		coords[settings[num][0]][3] = y2;

		

		if(c.w > 0 && c.h > 0){

		//	$('#crop').show();

		}else{

			//$('#crop').hide();

		}

		

	}

	

	

	controls.play.click(function(e){

		e.preventDefault();

		srart_p();	

			

	});

	$("a#in_start").click(function(e){

		e.preventDefault();

		in_start_p();

		

	});

	$("a#stop").click(function(e){

		e.preventDefault();

		stop_p(true);

		

	});

	controls.pause.click(function(e){

		e.preventDefault();

		pause_p();

		

	});

	

	

	var video = document.getElementById("player_video");
	var audio = document.getElementById("audio_player_cl");
	
	video.volume = 0;
	
	
	
	
	controls.volume_on.click(function(){
		controls.volume_off.show();
		controls.volume_on.hide();
		video.muted = !video.muted;
		
		
		audio.muted = !audio.muted;
	});
	
	controls.volume_off.click(function(){
		controls.volume_off.hide();
		controls.volume_on.show();
		video.muted = !video.muted;
		
		
		audio.muted = !audio.muted;
	});
	
	$(document).ready(function(e) {
		if(video.duration)
        controls.duration.text(formatTime(video.duration, controls.hasHours));
    });
	
	video.addEventListener("canplay", function() {
    	controls.hasHours = (video.duration / 3600) >= 1.0;                    
    	controls.duration.text(formatTime(video.duration, controls.hasHours));
    	controls.currentTime.text(formatTime(video.currentTime, controls.hasHours));
                  
    	//controls.duration_v.text(formatTime(video.duration, controls.hasHours));
    	//controls.currentTime_v.text(formatTime(0),controls.hasHours);
		
		if($('#audio_player_cl').attr('src') != '')
		audio.currentTime = video.currentTime;
	}, false);
	
	controls.fullscreen.click(function(){
		var elem = controls.fullscreen[0];
		if (elem.requestFullscreen) {
    		video.requestFullscreen();
		} else if (elem.mozRequestFullScreen) {
    		video.mozRequestFullScreen();
		} else if (elem.webkitRequestFullscreen) {
    		video.webkitRequestFullscreen();
		}
	});
	
	function formatTime(time, hours) {
    	if (hours) {
       		var h = Math.floor(time / 3600);
        	time = time - h * 3600;
                    
        	var m = Math.floor(time / 60);
        	var s = Math.floor(time % 60);
                    
        	return h.lead0(2)  + ":" + m.lead0(2) + ":" + s.lead0(2);
    	} else {
       		var m = Math.floor(time / 60);
        	var s = Math.floor(time % 60);
                    
        	return m.lead0(2) + ":" + s.lead0(2);
    	}
	}
            
	Number.prototype.lead0 = function(n) {
    	var nz = "" + this;
    	while (nz.length < n) {
        	nz = "0" + nz;
    	}
   		return nz;
	};
	
	video.addEventListener("timeupdate", function() {     
    	var progress = Math.floor(video.currentTime) / Math.floor(video.duration);
    	controls.progress[0].style.width = Math.floor(progress * controls.total.width()) + "px";
		
		progress = Math.floor(video.currentTime) / Math.floor(video.duration);
    	controls.progress_v[0].style.width = Math.floor(progress * controls.total_v.width()) + "px";
		
		controls.hasHours = (video.duration / 3600) >= 1.0;                    
    	controls.currentTime.text(formatTime(video.currentTime, controls.hasHours));
		
		sec = Math.round(video.currentTime*25);
		for(i = 0; i<=120000; i++){
			if(settings[i] && settings[i][1] == sec){
				num = i;
				break;
			}
		}
		change_photo(true);
		
		if(progress >= 1){
			stop_p(true);	
		}	 
		
	}, false);
	
	function change_num_sec(x){
		sec = Math.round(x * video.duration*25);
		for(i = 0; i<=120000; i++){
			if(settings[i] && settings[i][1] == sec){
				num = i;
				break;
			}
		}
		change_photo(true);
	}
	
	controls.total.click(function(e) {
    	var x = (e.pageX - this.offsetLeft)/$(this).width();
		change_num_sec(x);
    	video.currentTime = x * video.duration;
		if(controls.play.css('display') == 'none'){
			 
			audio.play();
		}
	});
	
	
	controls.total_v.click(function(e) {
    	var x = (e.pageX - $('#video_controls').offset().left - this.offsetLeft)/$(this).width();
		change_num_sec(x);
    	video.currentTime = x * video.duration;
	});
	
	
	controls.volume_pl.click(function(e) {
		var volume = ($(this).attr('volume'))/100;
		
		audio.volume = volume;
		var ch = false;
		_this = $(this);
		controls.volume_pl.each(function(){
			if(ch){
				$(this).addClass('fill0');
				
			}else{
				$(this).removeClass('fill0');
			}
			
			if(_this.attr('volume') == $(this).attr('volume')){
				ch = true;
			}
		})
		
	});
	
	controls.progress_volume.click(function(e) {
		var padd = (e.pageX - this.offsetLeft)-9;
		var volume = (e.pageX - this.offsetLeft)/$(this).width();
		
		
		controls.progress_img.css('padding-left', (padd > 0)? padd: 0);
		//video.volume = volume;
		
		
		audio.volume = volume;
		
		controls.progress_img_v.css('padding-left', Math.floor(volume*controls.progress_volume_v.width()));
	});
	
	controls.progress_volume_v.click(function(e) {
		var padd = (e.pageX - $('#video_controls').offset().left - this.offsetLeft)-7;
		var volume = (e.pageX - $('#video_controls').offset().left - this.offsetLeft)/$(this).width();;
		
		controls.progress_img_v.css('padding-left', (padd > 0)? padd: 0);
		//video.volume = volume;
		
		
		audio.volume = volume;
		
		controls.progress_img.css('padding-left', Math.floor(volume*controls.progress_volume.width()));
	});
	
	video.addEventListener("progress", function() {
    	var buffered = Math.floor(video.buffered.end(0)) / Math.floor(video.duration);

		controls.buffered[0].style.width =  Math.floor(buffered * controls.total.width()) + "px";
    	controls.buffered_v[0].style.width =  Math.floor(buffered * controls.total_v.width()) + "px";
	}, false);

	function srart_p(){

		//passed_time();

		//change_photo(false);

		if(text_settings){

			change_text();

		}

		controls.pause.show();

		controls.play.hide();

		video.currentTime = (sec>0)? sec/25:0;

		video.play();
		
		audio.play();
		
		//$('.audiojs .play-pause').trigger('click');

	}

	

	function pause_p(){

		clearInterval(timer);

		clearInterval(timer_s);

		clearInterval(timer_text);

		controls.pause.hide();

		controls.play.show();

		video.pause();
		
		audio.pause();
		
		//$('.audiojs .play-pause').trigger('click');

	}	

	function in_start_p(){

		clearInterval(timer);

		clearInterval(timer_s);

		clearInterval(timer_text);

		num = 0;

		sec = -1;

		num_text = 0

		passed_time();

		//change_photo(false);

		if(text_settings){

			change_text();

		}

		controls.pause.show();

		controls.play.hide();

		video.currentTime = 0;

		video.play();

	}

	function stop_p(stop_video){

		clearInterval(timer);

		clearInterval(timer_s);

		clearInterval(timer_text);


		num = 0;

		sec = -1;

		num_text = 0

		$('.show_img').hide();

		$('.min_size').hide();

		$('.show_text').html('');

		$('.show_text').hide();

		controls.pause.hide();

		controls.play.show();
		
		

		if(stop_video){

			video.currentTime = 0;

			video.pause();
			
			audio.pause();
			//$('.audiojs .play-pause').trigger('click');

		}

	}
	
	$(document).ready(function(e) {
        console.log('ready');
    });
</script>





<style>

	body{

		padding-top:0px !important;

	}
	
	.col-sm-3 {
    	width: 17%;
	}
	
	.navbar-nav {
    	float: right !important;
    	margin-top: 30px !important;
    	transition: margin-top 0.2s linear 0s !important;
	}
	
	.sticky .navbar-nav {
   		margin-top: 17px !important;
	}
	
	.navbar.sticky {
		border-radius:0px;
		border: none;
	}

	

	.create_video .show_img{

		display:none;

		margin-bottom:10px;


	}

	

	.create_video .video_maket{
		margin: 30px auto !important;

		padding-right:10px;

	}

	

	.create_video .video_maket video{

		width:453px; 

		height:256px;

	}

	

	.create_video .clear_line {width:100%; clear:both; float:none !important; height:1px !important; font-size:1px !important; border:none; margin-bottom: 20px; padding:0 !important; background:#7A829E;}

	

	.create_video .clear{width:100%; clear:both; float:none !important; height:1px !important; font-size:1px !important; border:none; margin: 0px !important; padding:0 !important; background:none !important;}

	

	.create_video .container {
    	width: 794px;
		margin: auto;
		padding: 0;
	}

	

	.create_video #fileupload .files tr{

		cursor:move;

	}

	

	.create_video .text_inp{
		background:#EEEEEE;
		
		width:400px;

		height:80px;

	}

	

	.create_video .text_area_block{

		margin-right:10px;

		margin-bottom:20px;

		float:left;

	}

	

	

	.create_video .player{

		margin-bottom:10px;

	}

	.create_video .player a{

		padding-right: 5px;

		cursor:pointer;

	}

	.create_video .player img{

		border:none;

	}

	.create_video .show_text{

		border: 1px solid #DADADA;

   		margin-bottom: 5px;

    	max-width: 300px;

    	text-align: center;

		display:none;

	}

	.create_video .min_size{

		display:none;

	}

	.create_video .min_size .size{

		font-weight:bold;

	}

	.create_video #mp3_viz{

		float:left;

	}

	.create_video #answer {

		text-align:center !important;

	}
	
	.img_prev_upl{
		opacity:1 !important;	
	}
	
	.img_prev_upl.in:nth-child(n+<?=sizeof($photo)+1;?>){
		opacity:0.3 !important;	
	}
	.show_img.img_clips{
		width:auto !important;
		height:auto !important;
	}
	
	.video_work_station .img_area{
		overflow:visible !important;
	}
	.cropFrame{
		border:2px solid #fff;
	}
	
	.video_work_station .img_area{
		height:290px !important;
		width:517px !important;
		margin:4px 0 0 31px !important;
	}
	body{
			background:#fff !important;
		}
	.imgs_uploader .img_prev_upl img {
		cursor: pointer !important;
		height: 64px;
	}

</style>