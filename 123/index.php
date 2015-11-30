<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");

$APPLICATION->SetPageProperty("title", "Создавай свое видео из фото на Fromfoto.com");

$APPLICATION->SetTitle("Создавай своё видео");
unset($_SESSION['sess_vk']);
?> 
<div class="content-title bold-title"> 
  <h2><b><span class="big_slog" style="box-sizing: border-box; font-size: 24px;">ХОТИТЕ СТИЛЬНЫЙ КЛИП ИЗ ФОТОГРАФИЙ ? 
        <br />
       </span></b> </h2>
 
  <p><span style="font-size: medium;">с профессиональной графикой, БЕСПЛАТНО и всего за 5 минут!</span></p>
 </div>
 
<div class="video main"> 	<img src="<?php echo SITE_TEMPLATE_PATH; ?>/images/imgo.jpg" class="img-for-mobile" style="display: none;"  /> 	<iframe frameborder="0" src="//www.youtube.com/embed/FT5kNiLXs8I?rel=0&amp;autoplay=0&amp;loop=0&amp;modestbranding=1&amp;showinfo=0&amp;loop=1&amp;hd=1&amp;controls=1&amp;" allowfullscreen="" style="width: 100%;"></iframe> </div>
 
<div class="content-info"> 
  <div id="vk_like"> 
    <br />
   </div>
 </div>
 <a href="/clips/" class="button-slide" >создать клип бесплатно</a> 
<div> 
  <br />
 
  <div id="vk_like"><font face="Arial" size="1.5" color="#555555"><b>КЛИПЫ НАШИХ ПОЛЬЗОВАТЕЛЕЙ:</b></font> 
    <p> </p>
   </div>
 
  <div id="videoslider"> 		 
    <div id="vs_moveleft" class="vs_button"> 
      <div class="vs_button_image"></div>
     </div>
   		 
    <div id="vs_moveright" class="vs_button"> 
      <div class="vs_button_image"></div>
     </div>
   		 
    <div id="vs_wrapper"> 			 
      <div id="vs_panel"> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/1.jpg" alt="video1" class="vs_thumbimage" video="https://www.youtube.com/embed/xunY1NuIYTg"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/2.jpg" alt="video2" class="vs_thumbimage" video="https://www.youtube.com/embed/jIZUJCLpstA"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/3.jpg" alt="video3" class="vs_thumbimage" video="https://www.youtube.com/embed/wGR3Bz0zqK8"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/4.jpg" alt="video4" class="vs_thumbimage" video="https://www.youtube.com/embed/30PYraDc-Ls"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/5.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/8Ppf28SG34Y"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/6.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/dGPCmv9iv54"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/7.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/JwZUrwOVF24"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/8.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/ZRxDrV_15F4"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/9.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/wGR3Bz0zqK8"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/10.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/if2WQAktogE"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/11.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/a7lpWo4s3W8"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/12.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/Q-i6Ldocyzw"  /> 			</div>
     		</div>
   	</div>
 	 
  <div id="vs_videoback"> 		 
    <div> 			<iframe width="500" height="250" src="" frameborder="0"></iframe> 		</div>
   	</div>
 </div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>