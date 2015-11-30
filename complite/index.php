<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клип в обработке");
?> <?
function prepare_row($str){
	return preg_replace("/|'/","",strip_tags($str));
}
$title=urlencode("Создаю свой клип :)");
$url=urlencode('http://fromfoto.com/');
$urlok=urlencode('http://fromfoto.com/');
//$urlok=urlencode("www.tut.by");
$titleok=urlencode('Пробую:)');
$summary=urlencode(prepare_row("БЕСПЛАТНЫЙ сервис для создания клипов из фотографий FromFoto.com. Попробуй!")); 
$image=urlencode('http://fromfoto.com/images/logo3.jpg');
?> 
<div class="content-title bold-title"> 	 ВАШ ЗАКАЗ ПРИНЯТ ! </div>
 
<div class="step-text sub_title">чтобы получить ваше готовое видео:</div>
 
<div class="step-text"><span>1)</span>Разместите репост на своей страничке Вконтакте (нажмите &quot;В&quot; ниже), если ещё не получили ссылку на свой клип
  <br />
 </div>
 <a onclick="yaCounter25315490.reachGoal('repost2'); window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" title="<?=GetMessage("S_SHARE_VK");?>" class="vk links-cab" ><img src="/images/icon-vk.png"  /></a> 
<div style="color: rgb(0, 74, 128); margin-top: 20px;" class="step-text">Не удаляйте репост пока мы обрабатываем клип, иначе производство Вашего видео прекратится.</div>
 
<div class="step-text"><span>2)</span>Перейдите Вконтакт и нажмите на картинку в репосте. В верхней части сайта для Вас откроется новая кнопка <font color="#004A80">Мой клип.</font></div>
 
<div style="color: rgb(0, 84, 165); margin-top: 40px; margin-bottom: 20px; text-align: center;">МЫ СДЕЛАЕМ ДЛЯ ВАС ОТЛИЧНЫЙ КЛИП! 
  <br />
 ДОБАВЛЯЙТЕСЬ В НАШУ ГРУППУ И БУДЬТЕ В КУРСЕ ВСЕХ НОВОСТЕЙ</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>