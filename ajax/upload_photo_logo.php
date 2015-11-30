<?php

$tmp = "";
if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp;
$filename = $_FILES['uploadlogo']['name'];
if(!preg_match('/\.jpg$|\.jpeg$|\.png$|\.gif$/', $filename, $ext)){
	echo "Неправильный формат!";
}
else{ 
$new_file_name = 'ph_logo'.rand(9999,9999999).$ext[0];
$file = $uploaddir . $new_file_name;

	if (!file_exists($uploaddir)) {

		mkdir($uploaddir, 0755, true);

	}

	if (move_uploaded_file($_FILES['uploadlogo']['tmp_name'], $file)) { 
		echo "<? xml version=\"1.0\"?>
<response>
<file>".$new_file_name."</file>
<answer>ok</answer>
</response>";
		exit();
	} 
}
?>