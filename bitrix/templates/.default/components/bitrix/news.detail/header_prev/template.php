<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?  /*if($_REQUEST['show']):?>
<div style="position:absolute;overflow: hidden; width:100%; height:900px;">

                	<video class="header_stick_video" style="height: 720px; position: relative; left: 50%; top: 0px; z-index: 0; width: 1280px; margin-left: -640px;" tabindex="0" id="player_video" autoplay="autoplay" loop="loop"> 
        <? if(isset($arResult['PROPERTIES']['VIDEO_MP4']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_MP4']['VALUE']);?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' /><? endif; ?>            
                    	
    	<? if(isset($arResult['PROPERTIES']['VIDEO_OGV']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_OGV']['VALUE']);?>" type='video/ogg; codecs="theora, vorbis"' /><? endif; ?>	
    	
  		<? if(isset($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE'])): ?><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_WEBM']['VALUE']);?>" type='video/webm; codecs="vp8, vorbis"' /><? endif; ?>
        
  			<h1><?=GetMessage("S_OLD_BROWSER")?></h1>
 	</video>
                    
                    
                    </div>
                  
<? endif; ?>              
              <? <div style="position:absolute;overflow: hidden; width:100%; height:660px;">
              <iframe style="position: relative; left: 50%; top: -100px; z-index: 0; margin-left: -750px;" src="//player.vimeo.com/video/101407894?title=0&byline=0&portrait=0&autoplay=1&loop=1" width="1500" height="843" frameborder="0"></iframe>
              </div>*/ ?>
                
                
                
                <div style="height:0px;" class="btn_order_sh">
                	<?  if($_REQUEST['show']):?>
                    	<img src="<?=SITE_TEMPLATE_PATH?>/img/head_pict3.png" style="border: medium none; position: relative; margin-left: -620px; left: 50%; top: -35px;" />
                        
                        <img src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" style="border: medium none; position: relative; margin-left: -1245px; left: 50%; top: -245px;" />
                        
                   <? else:?>
                   		<img src="<?=SITE_TEMPLATE_PATH?>/img/header_header.png" style="border: medium none; position: relative; margin-left: -620px; left: 50%; top: -35px;" />
						
						<img src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" style="border: medium none; position: relative; margin-left: -1326px; left: 50%; top: -120px;" />
                   <? endif; ?>
                        <style>
							<?  if($_REQUEST['show']):?>
							.vimeo_rott{
								width:505px !important;
								height:284px !important;
							}
							<? else:?>
							.vimeo_rott{
								width:505px !important;
								height:179px !important;
							}
							<? endif; ?>
							<?  if($_REQUEST['show']):?>
							.vimeo_rott {
								margin-left: -426px !important;
								top: 132px !important;
							}
							
							<? else:?>
							.vimeo_rott {
								margin-left: -426px !important;
								top: 80px !important;
							}
							<? endif; ?>
							
							.menu_hh{
								left:790px !important;
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_head2.png') no-repeat !important;
							}
							.menu_hh:hover{
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_head_hover2.png') no-repeat !important;
							}
							
							<?  if($_REQUEST['show']):?>
							.vimeo_rott iframe {
    							height: 246px !important;
    							width: 445px !important;
							}
							<? else:?>
							.vimeo_rott iframe{
								height: 252px !important;
    							left: 499px;
    							position: absolute;
    							top: -192px;
    							width: 448px !important;
							}
							<? endif; ?>
							
							<?  if($_REQUEST['show']):?>
							.gradient_on_video{
								left: 50%;
    							position: absolute;
    							top: 0px;
   							 	z-index: 999;
    							margin-left: 66px;
							}
							<? else:?>
							.gradient_on_video{
								left: 50%;
    							position: absolute;
    							top: -192px;
   							 	z-index: 999;
    							margin-left: 483px;
							}
							.navbar .navbar-decoration, .navbar{
								min-height: 80px !important;
							}
							.navbar .navbar-brand{
								padding-top: 5px;
							}
							.navbar .navbar-nav{
								margin-top: 20px;
							}
							
							.feature-item-title{
								margin: 0px 0px 0px 0px !important;
							}
							<? endif; ?>
							
							
							<?  if($_REQUEST['show']):?>
							.menu_hh{
								left: 50%;
  							 	top: 19px !important;
    							width: 388px !important;
								position:relative !important;
    							margin-left: 50px;
    							height: 151px !important;
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_head.png') no-repeat;
							}
							<? else:?>
							.features-two, .features-one, .features-three{
								padding-top: 15px !important;
								padding-bottom: 25px !important;
							}
							.features-icon{
								margin-bottom:0px !important;
								padding-bottom:0px !important;
							}
							.menu_hh{
								height: 151px !important;
								left: 50%;
								z-index:100;
								margin-left: -682px;
								position: relative !important;
								top: 223px !important;
								width: 388px !important;
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_head.png') no-repeat;
							}
							<? endif?>
							.menu_hh:hover{
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_head_hover.png') no-repeat;
							}
							.vimeo_rott{
								height: 236px;
    							left: 50%;
    							position:relative;
       							top: 145px;
        						width: 407px;
        						margin-left: -355px;
								z-index:99;
								display:none;
							}
						</style>
                        
                        
                        

					<?  /*else: ?>
                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" style="border: medium none; position: relative; margin-left: -<?=($arResult['DETAIL_PICTURE']['WIDTH']/2);?>px; left: 50%; top: 185px;" />
                    
					<? //endif;*/?>
                    	
                    </div>
                    
                  <script>
						function show_btn() {
  							$('.vimeo_rott').show();
						}
						
						var video = document.getElementById("player_video");
						state = 0;
						$('.btn_order_sh').click(function(e) {
                            if (!state) {
								video.pause();
								state = 1;
							}else{
								state = 0
								video.play();
							}
                        });
						setTimeout(show_btn, 500)
					</script>