<?
$filename = "count.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
if(!isset($_COOKIE['ch_count']) && isset($_REQUEST['add'])){
	setcookie ("ch_count", "1", time() + 3600*24*365);
	$handle = fopen($filename, "w+");
	fwrite($handle,$new_contns = $contents+1);
	fclose($handle);
	echo (int)$new_contns;
}else{
	echo (int)$contents;
}
?>