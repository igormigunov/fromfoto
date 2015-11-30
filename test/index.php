<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("соцсети");?>

<pre>
<?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}
$title=urlencode("Создаю свой клип на http://fromfoto.com/. Мой клип http://fromfoto.com/profile/hTfbNw5yPj7f/");
$url=urlencode("http://fromfoto.com/");
$summary=urlencode("Здесь можно БЕСПЛАТНО создавать своё видео из фото. Мой клип http://fromfoto.com/profile/hTfbNw5yPj7f/"); 
$image=urlencode('http://fromfoto.com/images/logo2.png');

/*
$get_polls = file_get_contents('https://api.vk.com/method/newsfeed.search?q=fromfoto');
$_json = json_decode($get_polls, TRUE);
echo("Репостов - ".(count($_json["response"])-1)."<br/>");
print_r($_json);
*/	
?>
	
<a href="" onclick="window.open('https://vk.com/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');" ><img src="/images/vk.png" /></a>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>