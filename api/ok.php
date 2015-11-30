<html prefix="og: http://ogp.me/ns#">
<html prefix="og: http://ogp.me/ns#">
<title>Клип из фотографий.</title>
<meta property="og:title" content="Клип из фотографий." />
<meta property="og:description" content="Бесплатно создаю клип из фотографий. Моё видео здесь: http://fromfoto.com/fljvrFG/" />
<meta property="og:url" content="http://fromfoto.com/123/" />
<meta property="og:image" content="http://fromfoto.com/images/logo40.jpg" />
</head>

<body>
<?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}

$urlok=urlencode('http://fromfoto.com/repost/'.rand(9999999, 99999999).'/');
$titleok=urlencode(prepare_row('Бесплатно создаю клип из фотографий. Моё видео здесь: http://fromfoto.com/123/'));
?>
<a href="#" onClick="window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=$urlok;?>','sharer','toolbar=0,status=0,width=548,height=325'); return false; ">расшарить ок</a>
</body>
</html>