<html prefix="og: http://ogp.me/ns#">
<html prefix="og: http://ogp.me/ns#">
<title>���� �� ����������.</title>
<meta property="og:title" content="���� �� ����������." />
<meta property="og:description" content="��������� ������ ���� �� ����������. �� ����� �����: http://fromfoto.com/fljvrFG/" />
<meta property="og:url" content="http://fromfoto.com/123/" />
<meta property="og:image" content="http://fromfoto.com/images/logo40.jpg" />
</head>

<body>
<?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}

$urlok=urlencode('http://fromfoto.com/repost/'.rand(9999999, 99999999).'/');
$titleok=urlencode(prepare_row('��������� ������ ���� �� ����������. �� ����� �����: http://fromfoto.com/123/'));
?>
<a href="#" onClick="window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=$urlok;?>','sharer','toolbar=0,status=0,width=548,height=325'); return false; ">��������� ��</a>
</body>
</html>