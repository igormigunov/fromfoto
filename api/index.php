<?
require 'vkapi.class.php';
//secret TcYgolJUX18EisEppVvQ 
$api_id = '4971414'; // Insert here id of your application
$vk_id = '19437897'; // Insert here you vk id
$client_secret = '6YPxittmboMVkcAWzl2Z';

$url = 'http://fromfoto.com/api_vk/';
$urlencode=urlencode('http://fromfoto.com/api_vk/');

if($_GET['code']){
	$token =  array(
		"client_id" => $api_id,
		"client_secret" => $client_secret,
		"redirect_uri" => $url,
		"code" => $_GET['code'],
	);
	$access_data = json_decode(get_access_token("https://api.vk.com/oauth/access_token", $token, "https://api.vk.com/"));
	$_SESSION['access_token'] = $access_data->access_token;
	$_SESSION['access_user_id'] = $access_data->user_id;
}
?>
<input type="button" value="FROM VK" onclick="window.open('https://oauth.vk.com/authorize?client_id=<?=$api_id; ?>&scope=photos&redirect_uri=<?=$urlencode; ?>&response_type=code&v=5.34&state=get_photo','sharer','toolbar=0,status=0,width=548,height=325');" />
<?


if($_SESSION['access_token']){
 
	$VK = new vkapi($api_id, $client_secret);
	 
	$resp = $VK->api('photos.getAll', 
		array(
			'access_token' => $_SESSION['access_token']
		)
	);
	print_r($resp);
}

function get_access_token($post_url, $post_data, $refer) 
{ 
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $post_url); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_REFERER, $refer); 
  curl_setopt($ch, CURLOPT_POST, 1); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
  curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17'); 
  
  $data = curl_exec($ch); 
  curl_close($ch); 
  
  return $data; 
}  
?>

