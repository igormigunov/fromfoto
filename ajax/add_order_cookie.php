<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if($_SESSION['PRODUCT_ID']){
	if($_COOKIE['ORDERS_ID']){
		setcookie("ORDERS_ID", $_COOKIE['ORDERS_ID'].','.$_SESSION['PRODUCT_ID'], time() + 3600*24*3, "/");
	}else{
		setcookie("ORDERS_ID", $_SESSION['PRODUCT_ID'], time() + 3600*24*3, "/");
	}
	echo $_SESSION['PRODUCT_ID'];
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>