<script>

	var er_file_types = '<?=GetMessage("S_ER_FILE_TYPES")?>';

	var er_maxFileSize = '<?=GetMessage("S_MAX_FILE_SIZE")?>';

	var er_minFileSize = '<?=GetMessage("S_MIN_FILE_SIZE")?>';

	var er_maxNumberOfFiles = '<?=GetMessage("S_MAX_NUMBR_FILES")?>';

</script>

<!-- The template to display files available for upload -->

<script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}

	<div class="img_prev_upl">
		<p class="size"><?=GetMessage("S_PROCESSING")?></p>

		<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
			
		<strong class="error text-danger"></strong>
	</div>  

{% } %}

</script>
<script>
function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
	{% if (!file.error && file.thumbnailUrl) { %}
	<div class="img_prev_upl">
		<span class="preview">            	

                {% if (file.thumbnailUrl) { %}
                    <img href="{%=file.url%}" real_width="{%=file.real_width%}" real_height="{%=file.real_height%}" file_name="{%=file.name%}" uniq_name="{%=file.name%}-{%=i%}" src="{%=file.url%}">

                {% } %}

		</span>
	</div>
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

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/main.js?112212312"></script>



<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui-1.10.4.custom.js"></script>



<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.Jcrop.min.js"></script>


<script src="<?=SITE_TEMPLATE_PATH?>/jquery-cropbox-master/jquery.cropbox.js"></script>



<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->

<!--[if (gte IE 8)&(lt IE 10)]>

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/cors/jquery.xdr-transport.js"></script>

<![endif]-->

<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script>
$( ".imgs_uploader" ).selectable({ filter: "div.img_prev_upl img" });
</script>


<script> 
	

	$('.delete.silver_btn').click(function(){
		$(this).removeClass('active_silver'); 
	}); 
	

	$('.imgs_uploader').on( "click", "img", function(e) {
		//$('.img_prev_upl img').css( "border", "none" );	
		sel_img = $(this);	
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
				video.currentTime = sec/25;
				change_photo(true);
			
				
				audio.currentTime = video.currentTime;
			}
		
		}
		//settings
		
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
	});
	
	$('html').keyup(function(e){
    	if(e.keyCode == 46){
			$('#fileupload .delete').trigger('click');	
		}
	});
	
	$(function(){
		
		

		$(".table-striped .files").sortable({

	    	opacity: 0.6,

	    	stop: function(event, ui) {

				var imgs = [];

				$(".table-striped .files .img_prev_upl .preview img").each(function(){

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
				
				
				//$('.img_block .clip_imgs').html('');

			}

	    });

	});

</script>





<?

$tmp = "";

if($_COOKIE['UPLOAD_FILES']){

	$tmp = $_COOKIE['UPLOAD_FILES']."/";

}

?>



    

    

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
		$next = "<div class=\"next_templ\"><span><a href=\"".SITE_DIR."create_video/?video_id=".$ar_fields['ID']."\">".GetMessage("S_NEXT_TPL")."</a></span></div></a>";
		break;
	}
}

$clips = array_reverse($clips);
foreach($clips as $ar_fields){
	if($arResult['ID'] > $ar_fields['ID'] && !$prev){
		$prev = "<div class=\"prev_templ\"><span><a href=\"".SITE_DIR."create_video/?video_id=".$ar_fields['ID']."\">".GetMessage("S_PREV_TPL")."</a></span></div>";
		break;
	}
}

if(!$prev){
	$prev = '<div style="float:left; height:130px; width:270px;"></div>';
}


?>

<script>

time_change = 40;
var count_pictures = '<?=sizeof($photo); ?>';
var timer_change_count_text_photo = setTimeout(function change_count_text_photo() {
	difference = parseInt(count_pictures) - parseInt($('.img_prev_upl .preview img').length);
	if(difference > 0){
		$('#count_pictures_container span.blue').html(difference);
		$('#count_pictures_container').show();
	}else{
		$('#count_pictures_container').hide();
	}
    timer_change_count_text_photo = setTimeout(change_count_text_photo, 1000);
  }, 1000);


_html = '<div class="name_block"><?=$prev;?><div class="clip_name"><div class="inner_bl_name"><h1><?=$arResult['NAME'];?></h1></div></div><?=$next;?></div>';
$('.navbar-title').html(_html);

$('.next_templ, .prev_templ').click(function(){
	window.location = $('a',$(this)).attr('href');	
})

$('#no_logo').screwDefaultButtons({
	image: 'url("<?=SITE_TEMPLATE_PATH?>/images/checkboxSmall.jpg")',
	width: 43,
	height: 43
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

	$("#order_clip_btn").click(function(e){

		e.preventDefault();

		$("#answer").html('<?=GetMessage("S_PROCESSING")?>');

		$("#order_clip_btn").hide();

		

		var imgs = [];

		$(".table-striped .img_prev_upl .preview img").each(function(index, element){
			if($('.clip_num_'+index+' img').length){
				coords[index][9] = parseInt(coords[index][6]) / parseInt(coords[index][4]);
			}
			if($('.clip_num_'+index+' img').length){
				if(coords[index]){
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($('.clip_num_'+index+' img').height());
			}else{
				coords[index][8] = parseInt($(this).attr("real_height")) / parseInt($('.img_area').height());
			}
			}
			imgs.push($(this).attr('href'));

		});

		

		var texts = [];

		$("textarea.text_inp").each(function(){

			texts.push($(this).val());

		});
		
		
		var no_logo = ($('#no_logo').is(":checked"))? 1:0;
		
		$.post("<?=SITE_DIR?>ajax/create_clip.php", {coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_feed").val(), name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', section_text_id:"<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>"}, function(data){

			if(data == 1){
				
				$.post("<?=SITE_DIR?>ajax/create_clip2.php", {coords:coords,no_logo:no_logo,imgs:imgs,texts:texts, email:$("#email_feed").val(), name:$("#name_feed").val(), mp3:$('#path_to_mp3').attr('path'), video_id:'<?=$_REQUEST['video_id'];?>', maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>'}, function(data){});
				_html = "<div class='container'><div class='row'><h1 style='text-align:center'><?=GetMessage("S_ORDERED_CLIP")?></h1></div></div>";
				$(".main").html(_html);

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

			}

			$("#order_clip_btn").show();

		});

	})



	$("#create").click(function(){

		var imgs = [];

		$(".table-striped .files tr .preview a").each(function(){

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
	
	var work_area_whidth = 519;
	var work_area_height = 290;

	<? foreach($photo as $k=>$v):?>

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

		coords.push([0,0,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>,<?=trim($real_size[0]);?>,<?=trim($real_size[1]);?>,1]);

		<? for($i=trim($time[0]);$i<trim($time[1]);$i++):?>

			settings.push([<?=$k;?>,<?=$i;?>,0,0,<?=trim($size[0]);?>,<?=trim($size[1]);?>]);

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

			return 'no_increment';

		}

		

		if(!$(".table.table-striped .img_prev_upl").eq(cur_picture).length){

			//alert(count+" <?=GetMessage("S_COUNT_PHOTOS")?>");	

			//stop_p(true);

			return false;

		}

		

		tr_need = $(".table.table-striped .img_prev_upl").eq(cur_picture);

		src = $(".preview img",tr_need).attr('href');
		
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
			
			if(width_pict>work_area_whidth){
				del = work_area_whidth/width_pict;
				width_pict = work_area_whidth;
				height_pict = Math.floor(height_pict*del);	
				
			}
			
			$('.img_clips.clip_num_'+cur_picture+' img').attr({'height': height_pict, 'width': width_pict});
			
			 $( '.img_clips.clip_num_'+cur_picture ).css({
				"width": width_pict+'px',
				"height": height_pict+'px'
			});
			
			new_width_jcrop = settings[numbr][4];
			new_height_jcrop = settings[numbr][5];
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
			
			paddy = ((work_area_height/2 - new_height_jcrop/2)>0)? work_area_height/2 - new_height_jcrop/2:0;
			paddx = ((work_area_whidth/2 - new_width_jcrop/2)>0)? work_area_whidth/2 - new_width_jcrop/2:0;
			
			console.log(width_pict+'-->'+height_pict+'---------'+paddx+'-->'+paddy);
			
			 $( '.img_clips.clip_num_'+cur_picture ).css({
				"padding-top": paddy+'px',
				"padding-left": paddx+'px'
			});
			
			$('.img_clips.clip_num_'+cur_picture+' img').cropbox({
				width: new_width_jcrop,
      			height: new_height_jcrop,
				img_width: width_pict,
				img_height: height_pict,
				showControls: 'never',
				result: {cropX:setx,cropY:sety,cropW:new_width_jcrop,cropH:new_height_jcrop}
    		}).on('cropbox', function(e, data) {
				coords[settings[num][0]][0] = data.cropX;

				coords[settings[num][0]][1] = data.cropW;

				coords[settings[num][0]][2] = data.cropY;

				coords[settings[num][0]][3] = data.cropH;
				
				//console.log('crop window: ' + data.cropX);
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
			
			console.log(width_pict,height_pict);
			
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

		}

		

		$('.clip_num_'+cur_picture).show();

		$('.min_size .size').html(settings[numbr][4]+"X"+settings[numbr][5]);
		
		$('.files .img_prev_upl img').each(function(index, element) {
            if($(this).attr('src') == $('.clip_num_'+cur_picture+' img').attr('src')){
				$(this).addClass("ui-selected");
				return true;
			}
        });

		//$('.min_size').show();
		
		if(parseInt(coords[settings[num][0]][6])>parseInt($(".preview img",tr_need).attr('real_width')) || parseInt(coords[settings[num][0]][7])>parseInt($(".preview img",tr_need).attr('real_height'))){
			$('.error_size').html('<?=GetMessage("S_WRANG_SIZE")?>'+coords[settings[num][0]][6]+'X'+coords[settings[num][0]][7]+'');
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

		float:left;

		padding-right:10px;

	}

	

	.create_video .video_maket video{

		width:453px; 

		height:256px;

	}

	

	.create_video .clear_line {width:100%; clear:both; float:none !important; height:1px !important; font-size:1px !important; border:none; margin-bottom: 20px; padding:0 !important; background:#7A829E;}

	

	.create_video .clear{width:100%; clear:both; float:none !important; height:1px !important; font-size:1px !important; border:none; margin: 0px !important; padding:0 !important; background:none !important;}

	

	.create_video .container {

    	width: 97% !important;

		padding-left:0px !important;

		padding-right:0px !important;

	}

	

	.create_video .table-striped .files tr{

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

	

	.create_video .container_h3{

		margin-top: 0px !important;

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
		opacity:0.3 !important;;	
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
	

</style>