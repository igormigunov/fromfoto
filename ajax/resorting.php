<?
if($_POST['imgs']){
	setcookie("IMGS_SORT", implode("|||",$_POST['imgs']), time()+86400*365, "/");
}

?>