<?
require 'vkapi.class.php';

$api_id = 4515976; // Insert here id of your application
$secret_key = 'AGNcO3012XXM5Nsm1zAL'; // Insert here secret key of your application

if($_REQUEST['code']){
	$content = file_get_contents('https://oauth.vk.com/access_token?client_id=4515976&client_secret=AGNcO3012XXM5Nsm1zAL&code='.$_REQUEST['code'].'&redirect_uri=http://fromfoto.com/api_social/vk/');

	
	$content = json_decode($content);
	echo '<pre>',print_r($content),'</pre>';
	
}

$VK = new vkapi($api_id, $secret_key);

$resp = $VK->api('getProfiles', array('uids'=>'19437897'));



$text = "111";
$sRequest = "https://api.vkontakte.ru/method/wall.post?owner_id=19437897&access_token=0736a0750bc6545ff873e266236a2e0f83590ff0b9ff450cd2a99517019297159c315956cbd82b44e303c&message=11111 11111 111111";

// ответ от Вконтакте
$oResponce = json_decode(file_get_contents($sRequest));

print_r($oResponce);

//print_r($resp);
?>

<script>
    var myWindow = window.open("https://api.vkontakte.ru/method/wall.post?owner_id=19437897&access_token=0736a0750bc6545ff873e266236a2e0f83590ff0b9ff450cd2a99517019297159c315956cbd82b44e303c&message=11111 11111 111111", "", "width=600, height=300");
</script>
