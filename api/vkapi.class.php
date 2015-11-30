<?php
 
/**
 * VKAPI class for vk.com social network
 *
 * @package server API methods
 * @autor http://muhmundr.com/
 * @version 2.0
 */
 
function Send_Post($post_url, $post_data, $refer) 
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
 
class vkapi {
  var $client_secret;
  var $app_id;
	var $api_url;
	
	function vkapi($app_id, $client_secret, $api_url = 'api.vk.com/api.php') {
		$this->app_id = $app_id;
		$this->client_secret = $client_secret;
		if (!strstr($api_url, 'http://')) $api_url = 'http://'.$api_url;
		$this->api_url = $api_url;
	}
	
	function api($method,$params=false) {
		if (!$params) $params = array(); 
		$params['client_id'] = $this->app_id;
 
		ksort($params);
		$sig = array();;
		foreach($params as $k=>$v) {
			$sig[] = $k.'='.$v;
		}
		$sig = implode("&", $sig);
		
		echo '<br /><br />', '/method/'.$method.'?'.$sig.$this->client_secret, '<br /><br />';
		$params['sig'] = md5('/method/'.$method.'?'.$sig.$this->client_secret);
		print_r($params);
		$res = Send_Post($this->api_url,$this->params($params),'http://vk.com/app'.$this->app_id.'_'.$this->app_id);
		return simplexml_load_string($res);
	}
	
	function params($params) {
		$pice = array();
		foreach($params as $k=>$v) {
			$pice[] = $k.'='.urlencode($v);
		}
		return implode('&',$pice);
	}
}
?>
