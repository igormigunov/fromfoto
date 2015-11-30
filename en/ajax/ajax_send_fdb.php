<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?
$errors = array();
if($_POST){
	$regex = '/^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/';
	
	if(!(trim($_POST['name']))){
		$errors[] = "Enter your name!";
	}
	if(!(trim($_POST['text']))){
		$errors[] = "Enter your message!";
	}
	if(!(trim($_POST['email'])) || !preg_match($regex, $_POST['email'])){
		$errors[] = "Please enter a valid e-mail!";
	}
}
if(!$errors){
	$arFields = array(
		"AUTHOR" => $_POST['name'],
  		"AUTHOR_EMAIL" => $_POST['email'],
		"TEXT" => $_POST['text'],
		);
	CEvent::SendImmediate("FEEDBACK_FORM", "en", $arFields);
	echo "1";
}else{
	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";
}
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>