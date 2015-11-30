<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<? //require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>

<?
require_once $_SERVER["DOCUMENT_ROOT"].'/lib/Zend/Loader.php';

Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_App_Exception');


$authenticationURL= 'https://www.google.com/youtube/accounts/ClientLogin';

$httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                                $username = 'fromfoto.com@gmail.com',
                                $password = '12345qwerty11',
                                $service = 'youtube',
                                $client = null,
                                $source = 'ethereal-runner-761', // a short string identifying your application
                                $loginToken = null,
                                $loginCaptcha = null,
                                $authenticationURL);
 
$myDeveloperKey = 'AIzaSyAzBfWhsFXTd6bzwHasXSqDstqpzFcOZ8A';
//$myDeveloperKey = 'AIzaSyBvzL2MAy6g9r0tSJmZ0Racu3-ClQpNxCw';

$httpClient->setHeaders('X-GData-Key', "key=${myDeveloperKey}");

$yt = new Zend_Gdata_YouTube($httpClient);

// create a new Zend_Gdata_YouTube_VideoEntry object
$myVideoEntry = new Zend_Gdata_YouTube_VideoEntry();
?>


<?

CModule::IncludeModule("iblock");



$clip_ids = array();

foreach($_REQUEST as $k=>$v){

	if(preg_match("/zakaz/",$k)){

		$ids = explode("_",$v);

		$clip_ids[] = $ids[0];

	}

}



$arFilter = Array(

   "IBLOCK_TYPE"=>"clips", 

   "ACTIVE"=>"Y", 

   "ID"=>$clip_ids

   );

$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TYPE_CLIP","PROPERTY_USER_EMAIL", "PROPERTY_PAID", "PROPERTY_USER_NAME","PROPERTY_USER","PROPERTY_NO_LOGO","PROPERTY_VIDEO_COUNT","PROPERTY_TELL_FRIENDS", "PROPERTY_PREVIEW_VIDEO"));



$ar_clip = array();

$clip_options_id = array();

while($clip = $res->GetNext()){

	$ar_clip[$clip['ID']] = $clip;

	$clip_options_id[] = $clip['PROPERTY_TYPE_CLIP_VALUE'];

}



$arFilter = Array(

   "IBLOCK_TYPE"=>"clips", 

   "ACTIVE"=>"Y", 

   "ID"=>$clip_options_id

   );

$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","IBLOCK_ID","PROPERTY_FREE_PERIOD"));



$ar_clip_option = array();

while($clip_option = $res->GetNext()){

	$ar_clip_option[$clip_option['ID']] = $clip_option;

}





foreach($ar_clip as $k=>$v){

	$ar_clip[$k]['clip_options'] = $ar_clip_option[$v['PROPERTY_TYPE_CLIP_VALUE']];

}




/*
$conf = new Config();

$logger = new Logger();

$YaAuth = new YaAuth($conf,$logger);

$YaDisk = new YaDisk($YaAuth->getToken(),$conf,$logger);
*/




$videos = array();

$folders = array();

foreach($_REQUEST as $k=>$v){

	if(preg_match("/zakaz/",$k)){
		
		$folders[$v] = $v;

		/*$files = $YaDisk->ls('/'.$v.'/Video/');

		if(is_array($files)){

			foreach($files as $k_f=>$v_f){

				if($v_f['type'] == 'f' && preg_match("/\.mp4/",$v_f['href'])){

					$videos[$v][] = $v_f['href'];

					//break 1;

				}

			}

		}*/

	}

}




foreach($folders as $k=>$v){
	
	
	$ids = explode("_",$k);
	

	//$YaDisk->download($v[0],'/upload/clips'.$v[0]);
	//$YaDisk->download($v[1],'/upload/clips'.$v[1]);
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$ids[0]))
	{
		echo 'получено';
		return;
	}
	
	$rsUser = CUser::GetByID($ar_clip[$ids[0]]['PROPERTY_USER_VALUE']);
	$arUser = $rsUser->Fetch();
	
	$arFields = array(

		"NAME" => $arUser['NAME'],

		"EMAIL" => $arUser['EMAIL'],

		"LINK_TO" => 'http://'.$_SERVER['HTTP_HOST'].'/show_preview/?clip='.rand(100, 999).$ids[0],

	 );
	 
	 $site_id = "s1";
	$TYPE_ORD = "CREATE_CLIP_PREV";
	if($arUser['EMAIL']){
		CEvent::SendImmediate($TYPE_ORD, $site_id, $arFields);
	}
	
	

	$PROP = array();
	
	$paid_clip = $v.'.mp4';
	$prev_clip = $v.'_preview.mp4';
	$prev_clip_2 = $v.'_preview2.mp4';
	
	//$paid_clip = (preg_match("/preview/",$v[0]))?$v[1]:$v[0];
	//$prev_clip = (preg_match("/preview/",$v[0]))?$v[0]:$v[1];

	
	
	if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$ids[0].'/')) {
    	mkdir($_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$ids[0].'/', 0755, true);
	}
	//$old_path = $_SERVER["DOCUMENT_ROOT"].'/upload/clips'.$paid_clip;
	$old_path = '/home/admin/zakaz/'.$v.'/Video/'.$paid_clip;
	$old_preview_path = '/home/admin/zakaz/'.$v.'/Video/'.$prev_clip_2;
	
	$file_name = rand(999,9999).'.mp4';
	$file_path = $_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$ids[0].'/'.$file_name;
	copy($old_path,$file_path);
	$PROP[127] = '/paid_clip/'.$ids[0].'/'.$file_name;
	
	$file_prev_name = rand(999,9999).'_prev.mp4';
	$file_prev_path = $_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$ids[0].'/'.$file_prev_name;
	copy($old_preview_path, $file_prev_path);
	$PROP[225] = '/paid_clip/'.$ids[0].'/'.$file_prev_name;
		
	
	//if(isset($ar_clip[$ids[0]]['clip_options']['PROPERTY_FREE_PERIOD_VALUE']) && $ar_clip[$ids[0]]['clip_options']['PROPERTY_FREE_PERIOD_VALUE']){
		//$PROP[109] = 5;
		//$PROP[108] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].'/upload/clips'.$paid_clip);
		//$PROP[108] = CFile::MakeFileArray('/home/admin/zakaz/'.$v.'/Video/'.$paid_clip);
	//}else{
		//$PROP[108] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].'/upload/clips'.$prev_clip);
		$PROP[108] = CFile::MakeFileArray('/home/admin/zakaz/'.$v.'/Video/'.$prev_clip);
	//}
	
	$PROP[109] = ($ar_clip[$ids[0]]['PROPERTY_PAID_VALUE'])?5:0;

	$PROP[110] = $ar_clip[$ids[0]]['PROPERTY_TYPE_CLIP_VALUE'];

	$PROP[107] = $ar_clip[$ids[0]]['PROPERTY_USER_EMAIL_VALUE'];
	$PROP[107] = $arUser['NAME'];

	$PROP[106] = $ar_clip[$ids[0]]['PROPERTY_USER_NAME_VALUE'];
	$PROP[106] = $arUser['EMAIL'];
	
	$PROP[185] = $ar_clip[$ids[0]]['PROPERTY_VIDEO_COUNT_VALUE'];
	
	$PROP[209] = $ar_clip[$ids[0]]['PROPERTY_USER_VALUE'];
	
	$PROP[218] = $ar_clip[$ids[0]]['PROPERTY_TELL_FRIENDS_ENUM_ID'];

	$PROP[177] = ($ar_clip[$ids[0]]['PROPERTY_NO_LOGO_VALUE'])?37:0;
	
//yotube
	// create a new Zend_Gdata_App_MediaFileSource object
	//$filesource = $yt->newMediaFileSource($_SERVER["DOCUMENT_ROOT"].$PROP[127]);
	$filesource = $yt->newMediaFileSource('/home/admin/zakaz/'.$v.'/Video/'.$prev_clip);
	$filesource->setContentType('video/mp4');
	// set slug header
	$filesource->setSlug($file_name);
	
	// add the filesource to the video entry
	$myVideoEntry->setMediaSource($filesource);
	
	//$myVideoEntry->setVideoTitle("FromFoto.com код клипа ".substr($file_name, 0, -4));
	$myVideoEntry->setVideoTitle("Как сделать слайд-шоу и красивые клипы");
	$myVideoEntry->setVideoDescription('Создавайте БЕСПЛАТНЫЕ слайд-шоу на http://fromfoto.com/ ! Выберите понравившейся шаблон, загрузите свои фото\текст\музыку и получите готовый клип!');

	$myVideoEntry->setVideoCategory('Nonprofit');
	$myVideoEntry->SetVideoTags('activism, temporary');
	$myVideoEntry->setVideoPublic();
		
	// upload URL for the currently authenticated user
	$uploadUrl = 'http://uploads.gdata.youtube.com/feeds/api/users/default/uploads';
	
	try {
	  $newEntry = $yt->insertEntry($myVideoEntry, $uploadUrl, 'Zend_Gdata_YouTube_VideoEntry');
		$headers = $newEntry->getHeaders();
//http://youtu.be/CRZ5trrA1bQ
 		$PROP[217] = "http://youtu.be/".substr($headers["Location"], strripos($headers["Location"], "/uploads/")+9);
		  
	} catch (Zend_Gdata_App_Exception $e) {
	    $PROP[217] = $e->getMessage();
	}

	$arLoadProductArray = Array(

 	 "MODIFIED_BY"    => 1,

 	 "IBLOCK_SECTION" => false,

 	 "PROPERTY_VALUES"=> $PROP,

 	 "ACTIVE"         => "Y",

	 "ACTIVE_TO"      => date("d.m.Y H:i:s",time()+3600*24*$day_commerc)

 	 );

	 
	$el = new CIBlockElement;

	 $res = $el->Update($ids[0], $arLoadProductArray);
	 

	//unlink($_SERVER["DOCUMENT_ROOT"].'/upload/clips/'.$v[0]);
	//unlink($_SERVER["DOCUMENT_ROOT"].'/upload/clips/'.$v[1]);
	
	echo 'получено';

}



?>





<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>