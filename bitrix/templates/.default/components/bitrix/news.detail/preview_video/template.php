

<? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']) || isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])):?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/template_styles.css">
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.js"></script>


    <video style="width:716px; height:404px; margin-left: 13px;" autoplay="autoplay" id="player_video"> 	
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
    
    
    <div class="synchronization" style="margin:0px; margin-top: 13px;">
        	<div class="play_pause">
            	<a class="start" style="display:none;" title="<?=GetMessage("S_START_VIDEO")?>">

				</a>
        		<a class="pause" title="<?=GetMessage("S_PAUSE")?>">

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
        
<script>
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
var video = document.getElementById("player_video");
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
	
controls.play.click(function(e){

		e.preventDefault();

		srart_p();		

	});
	
controls.pause.click(function(e){

		e.preventDefault();

		pause_p();

		

	});
	
controls.volume_on.click(function(){
		controls.volume_off.show();
		controls.volume_on.hide();
		video.muted = !video.muted;
	});
	
	controls.volume_off.click(function(){
		controls.volume_off.hide();
		controls.volume_on.show();
		video.muted = !video.muted;
	});
	
$(document).ready(function(e) {
		if(video.duration)
        controls.duration.text(formatTime(video.duration, controls.hasHours));
    });
	
video.addEventListener("canplay", function() {
    	controls.hasHours = (video.duration / 3600) >= 1.0;                    
    	controls.duration.text(formatTime(video.duration, controls.hasHours));
    	controls.currentTime.text(formatTime(video.currentTime, controls.hasHours));
		srart_p();
                  
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
		
		if(progress >= 1){
			stop_p(true);	
		}	 
		
	}, false);
	
	function change_num_sec(x){
	}
	
	controls.total.click(function(e) {
    	var x = (e.pageX - this.offsetLeft)/$(this).width();
		change_num_sec(x);
    	video.currentTime = x * video.duration;
	});
	
	
	controls.total_v.click(function(e) {
    	var x = (e.pageX - $('#video_controls').offset().left - this.offsetLeft)/$(this).width();
		change_num_sec(x);
    	video.currentTime = x * video.duration;
	});
	
	
	controls.volume_pl.click(function(e) {
		var volume = ($(this).attr('volume'))/100;
		var ch = false;
		_this = $(this);
		video.volume = volume;
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
		
		controls.progress_img_v.css('padding-left', Math.floor(volume*controls.progress_volume_v.width()));
	});
	
	controls.progress_volume_v.click(function(e) {
		var padd = (e.pageX - $('#video_controls').offset().left - this.offsetLeft)-7;
		var volume = (e.pageX - $('#video_controls').offset().left - this.offsetLeft)/$(this).width();;
		
		controls.progress_img_v.css('padding-left', (padd > 0)? padd: 0);
		//video.volume = volume;
		
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


		controls.pause.show();

		controls.play.hide();

		video.play();
		

	}

	

	function pause_p(){


		controls.pause.hide();

		controls.play.show();

		video.pause();

	}	

	

	function stop_p(stop_video){


		controls.pause.hide();

		controls.play.show();
		
		

		if(stop_video){

			video.currentTime = 0;

			video.pause();

		}

	}
</script>    
<? endif; ?>

<style>
	body{
		margin:0px !important;
	}
</style>
    