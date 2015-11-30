<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клип в обработке");
?> 
 <?
function prepare_row($str){
	return preg_replace("/|'/","",strip_tags($str));
}
$title=urlencode("Моё видео здесь: http://fromfoto.com/fljvrFG/");
$url=urlencode('http://fromfoto.com/');
$urlok=urlencode('http://fromfoto.com/');
//$urlok=urlencode("www.tut.by");
$titleok=urlencode('Пробую:)');
$summary=urlencode(prepare_row("Онлайн, без регистрации и установки программ!")); 
$image=urlencode('http://fromfoto.com/images/logo24.jpg');
?>
<div class="content-title bold-title">
	  ВАШ ЗАКАЗ ПРИНЯТ !    
</div>
<div class="step-text sub_title">чтобы пройти в ваш личный кабинет с видео:</div>
<div class="step-text"><span>1)</span>Разместите наш рекламный репост на своей страничке Вконтакте (нажмите "В" ниже).<br /></div>
<a onclick="yaCounter25315490.reachGoal('repost2'); window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" title="<?=GetMessage("S_SHARE_VK");?>" class="vk links-cab"><img src="/images/icon-vk.png" alt=""></a>
<div style="color: #004A80; margin-top: 20px;" class="step-text">Не удаляйте репост пока мы обрабатываем ваш клип в профессиональной программе,
иначе изготовление видео прекратится.</div>
<div class="step-text"><span>2)</span>Перейдите Вконтакт и нажмите на картинку в репосте. В верхней части сайта
для Вас откроется новая кнопка <font color="#004A80">Мой клип.</font></div>

<div style="color: #0054a5;  margin-top: 40px; margin-bottom:20px; text-align: center;  ">МЫ СДЕЛАЕМ ДЛЯ ВАС ОТЛИЧНЫЙ КЛИП!<br />
ДОБАВЛЯЙТЕСЬ В НАШУ ГРУППУ И БУДЬТЕ В КУРСЕ ВСЕХ НОВОСТЕЙ</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>