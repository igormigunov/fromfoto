<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");

$APPLICATION->SetPageProperty("title", "Создавай свое видео из фото на Fromfoto.com");

$APPLICATION->SetTitle("Создавай своё видео");

?> 
<div class="header_slog"> <span class="big_slog">Яркие клипы из воспоминаний!</span> 
  <br />
 <span class="small_slog">создайте БЕСПЛАТНО слайд-шоу всего за 5 минут!</span> </div>
 
<div class="video_part"> <iframe style="width: 500px; height: 275px;" src="//http://http://www.youtube.com/embed/27ZSQgaMi-Qfeature=player_detailpage?rel=0&amp;autoplay=1&amp;loop=1" frameborder="0" allowfullscreen=""></iframe> 	 
  <div class="like_box"> 		 
    <div id="vk_like"> <img src="/images/like_vk.png" id="like_vk"  /> <input class="like_vk" value="1678" /> </div>
   	 
<script type="text/javascript">
			   //VK.Widgets.Like("vk_like", {type: "mini"});
			</script>
 	</div>
 </div>
 
<div class="centr_head"> 	 
  <p><font color="#111111">3 простых шага :</font></p>
 </div>
 
<ol class="list_third"> 
  <li><font color="#111111">выберите шаблон на нашем сайте</font></li>
 
  <li><font color="#111111">закиньте в него свои фотографии</font></li>
 
  <li><font color="#111111">получите свой клип: быстро и легко!</font></li>
 </ol>
 
<div class="btn_blg"> 	<a href="/clips/" class="btn_go" >сделать слайд-шоу 
    <br />
   бесплатно</a> </div>
 
<div class="small-text"> 	 
  <p>сервис полностью автоматизирован и не требует от пользователя навыков владения специальными программами</p>
 </div>
 
<style>
	input.like_vk{
		border: 1px solid #bcc4d2;
    	height: 34px;
   		margin: 4px 0 0 4px;
    	border-radius: 3px;
   		width: 42px;
	}
	#like_vk{
		 border: medium none;
    	cursor: pointer;
    	margin-top: -3px;
		height: 25px;
	}
  .btn_go {
    width: 100%;
    height: auto;
    font-size: 11px;
    padding: 5px;
    text-transform: uppercase;
  }
  .small-text {
    color: rgb(0, 0, 0);
    font-size: 12px;
    text-align: center;
  }
</style>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>