<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/classes/ac_image_class.php");?>
<?

$x1=round($_POST['coords'][$_POST['num_img']][0]);
$y1 = round($_POST['coords'][$_POST['num_img']][2]);
$kx=round($_POST['coords'][$_POST['num_img']][6]/$_POST['coords'][$_POST['num_img']][4],10);
$ky=round($_POST['coords'][$_POST['num_img']][7]/$_POST['coords'][$_POST['num_img']][5],10);
$_POST['imgs']=$_SERVER["DOCUMENT_ROOT"].$_POST['imgs'];
$img = new acResizeImage($_POST['imgs']);
if($kx*$x1>$ky*$y1) {
    $img->resize(0, $_POST['coords'][$_POST['num_img']][7]);
}elseif($kx*$x1!=0 or $ky*$y1!=0){
    $img->resize($_POST['coords'][$_POST['num_img']][6], 0);
}else{
    echo json_encode(array($kx,$ky,$x1,$y1));
    return false;
}
$out=explode(".",$_POST['file_out']);
array_pop($out);
$out=implode("",$out);
$path=$img->crop($x1*$kx,$y1*$ky,$_POST['coords'][$_POST['num_img']][6],$_POST['coords'][$_POST['num_img']][7])->save("/home/admin/zakaz/".$_POST['prod_id']."_33/",$out ,false,true);
copy($path,$_SERVER["DOCUMENT_ROOT"].$_POST['cur_url']);
echo $path;
die();
?>
