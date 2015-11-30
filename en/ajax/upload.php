<?php

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$tmp = date('y-m-d-H-i-s').rand(99999,9999999)."/";
if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}
$upload_handler = new UploadHandler(array('script_url'=>'/ajax/upload.php','upload_dir'=>$_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp,'upload_url'=>'/upload/tmp/'.$tmp));

/*$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/';
$filename = $_FILES['uploadfile']['name'];
$file = $uploaddir . basename($filename);
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); 
$filetypes = array('.jpg', '.gif', '.bmp', '.png', '.jpeg', '.JPG', '.GIF', '.BMP', '.PNG', '.JPEG');
if(!in_array($ext, $filetypes)){
	echo "Неправильный формат!";
}
else{ 
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
		echo "ok"; 
	} 
}*/
?>