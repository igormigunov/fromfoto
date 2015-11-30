<?
class Logger{
	public function logg($error)
    {
		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/logg.php', 'a+');
		
		$text = '\r\n ----------------------'.date('Y-m-d H:i:s').'-----------------------\r\n';
		
		$text = $text.$error;
		
		$text = $text.'\r\n ----------------------!!!!!-----------------------\r\n';
			
		fwrite($fp, $text);

		fclose($fp);
	}
}


class Config{
	private $data = array();
	
	function __construct()
 	{
		$this->data['oauth_app_id'] = 'd5d373c6a8f44351922892f94acdbae6';
		$this->data['oauth_token_url'] = 'https://oauth.yandex.ru/token';
		$this->data['oauth_referer_url'] = 'http://video_gallery/';
		$this->data['oauth_app_secret'] = '8333296113f2491fa62ce44231f427bb';
		$this->data['oauth_login'] = 'iljanew2@yandex.ru';
		$this->data['oauth_password'] = 'iljanew';
		
		
		$this->data['disk_work_url'] = 'https://webdav.yandex.ru';
		$this->data['disk_port'] = '443';
		
	}
	public function __get($name)
    {
		
		if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }else{
			return false;	
		}
	}
}

class YaAuth
{
  protected $token;
  protected $error;
  protected $create_time;
  protected $ttl;
  protected $app_id;
  protected $conf;
  protected $logger;
  
  function __construct($conf,$logger)
  {
    $this->logger = $logger;
    $this->app_id = $conf->oauth_app_id;
    $this->clear();
    $this->conf = $conf;
  }

  function getToken()
  {
    if($this->checkToken())
      return $this->token;

    $url = $this->conf->oauth_token_url;
    $curl = curl_init($url);
    
    curl_setopt($curl,CURLOPT_HEADER,0);
    curl_setopt($curl,CURLOPT_REFERER,$this->conf->oauth_referer_url);
    
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,1);
    curl_setopt($curl,CURLOPT_FRESH_CONNECT,1);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_FORBID_REUSE,1);
    curl_setopt($curl,CURLOPT_TIMEOUT,4);

    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
  
    $post = 'grant_type=password&client_id='.$this->conf->oauth_app_id.
            '&client_secret='.$this->conf->oauth_app_secret.
            '&username='.$this->conf->oauth_login.
            '&password='.$this->conf->oauth_password;

    $header = array(/*'Host: oauth.yandex.ru',*/
                    'Content-type: application/x-www-form-urlencoded',
                    'Content-Length: '.strlen($post)
                   );
    
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
	curl_setopt ($curl, CURLOPT_POSTFIELDS, $post);

    $json = curl_exec($curl);

    if(!$json)
    {
      $this->error = curl_error($curl);
      $this->logger->logg($this->error);
      return false;
    }

    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if(($http_code!='200') && ($http_code!='400'))
    {
      $this->error = "Request Status is ".$http_code;
      $this->logger->logg($this->error);
      return false;
    }
  
    $result = json_decode($json, true);

    if (isset($result['error']) && ($result['error'] != ''))
    {
      $this->error = $result['error'];
      $this->logger->logg($this->error);
      return false;
    }

    $this->token = $result['access_token'];
    $this->ttl = (int)$result['expires_in']; 
    $this->create_time = (int)time();
	curl_close ($curl);
    return $this->token;
  }
 
  function clear()
  {
    $this->token = '';
    $this->error = '';
    $this->counter_id = '';
    $this->create_time = 0;
    $this->ttl = -1;
  }

  
  
  function checkToken()
  {
    if ($this->ttl <= 0) return false;
  
    if (time()>($this->ttl+$this->create_time))
    {
      $this->error = 'token_outdated';
      $this->logger->logg($this->error);
      return false;
    }
    return true;
  }
  
  function getError()
  {
    return $this->error;
  }
  
}



class YaDisk
{ 
  protected $auth;
  protected $config;
  protected $error;
  protected $token;
  protected $logger;
  protected $url;
  
  function __construct($token,$config,$logger)
  {
    $this->auth = $auth;
    $this->config = $config; 
    $this->token = $token;
    $this->logger = $logger;
  } 

  function getCurl($urik)
  {
    $curl = curl_init($urik);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_PORT,$this->config->disk_port);
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,2);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_HEADER, 0);
    curl_setopt($curl,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($curl,CURLOPT_URL,$urik);
    $header = array('Accept: */*',
                    "Authorization: OAuth {$this->token}"
                   );
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    return $curl;
  }

  function getResult($curl, $codes = array())
  {
    if(curl_error($curl))
    {
      $this->error = curl_error($curl);
      $this->logger->logg($this->error);
      return false;
    } 
    else
    {
      if (!in_array(curl_getinfo($curl, CURLINFO_HTTP_CODE),$codes))
      {
        $this->error = 'Response http error:'.curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $this->logger->logg($this->error);
        return false;
      }
      else
      {
        return true;
      }
    }
  }

  function mkdir($folder)
  {
    $curl = $this->getCurl($this->config->disk_work_url.$folder);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"MKCOL");
    $response = curl_exec($curl);
    return $this->getResult($curl, array(201,405));//405
  }

  function upload($local_src,$file)
  {
	$local_src = $_SERVER['DOCUMENT_ROOT'].$local_src;
    $local_file = fopen($local_src,"r");
    $curl = $this->getCurl($this->config->disk_work_url.$file);
    curl_setopt($curl,CURLOPT_PUT, 1);
    curl_setopt($curl,CURLOPT_INFILE,$local_file);
    curl_setopt($curl,CURLOPT_INFILESIZE, filesize($local_src));
    $header = array('Accept: */*',
                    "Authorization: OAuth {$this->token}",
                    'Expect: '
                   );
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    $response = curl_exec($curl);
    fclose($local_file);
    return $this->getResult($curl, array(200,201,204));    
  }

  function download($server_src,$local_dst)
  {
	$paths = explode("/",$local_dst);
	unset($paths[sizeof($paths)-1]);
	$path = implode("/",$paths);
	if (!file_exists($_SERVER['DOCUMENT_ROOT'].$path)) {
		mkdir($_SERVER['DOCUMENT_ROOT'].$path, 0755, true);
	}
	
	$local_dst = $_SERVER['DOCUMENT_ROOT'].$local_dst;
	  
	  
    $local_file = fopen($local_dst,"w");
    $curl = $this->getCurl($this->config->disk_work_url.$server_src);
    curl_setopt($curl,CURLOPT_HTTPGET, 1);
    curl_setopt($curl,CURLOPT_HEADER, 0);
    curl_setopt($curl,CURLOPT_FILE,$local_file);
    $response = curl_exec($curl);
    fclose($local_file);
    return $this->getResult($curl, array(200));    
  }

  function rm($server_src)
  {
    $curl = $this->getCurl($server_src);
    $curl->setOpt(CURLOPT_CUSTOMREQUEST,"DELETE");
    $response = $curl->open();
    return $this->getResult($curl, array(200));    
  }  
  
  function ls($server_src)
  {
    $curl = $this->getCurl($this->config->disk_work_url.$server_src);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PROPFIND");
    $header = array('Accept: */*',
                    "Authorization: OAuth {$this->token}",
                    'Depth: 1',
                   );
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    $response = curl_exec($curl);
    if($this->getResult($curl, array(207)))
    {
      $xml = simplexml_load_string($response,"SimpleXMLElement" ,0,"d",true);
      $list = array();
      foreach($xml as $item)
      {
        if(isset($item->propstat->prop->resourcetype->collection))
          $type = 'd';
        else
          $type = 'f';
        $list[]=array('href'=>(string)$item->href,'type'=>$type);
      }
      return $list; 
    }
    return false;    
  }

  //Ugly. 
  function exists($server_src)
  { 
    $path = dirname($server_src);
    $list = $this->ls($path);
    if($list === false)
    {
      $this->error = 'Не могу получить список файлов';
      $this->logger->log('','ERROR', $this->error);
      return false;
    }
    foreach($list as $item)
      if(rtrim($item['href'],'/')==rtrim($server_src,'/'))
        return true;
    return false;
  }

  //Ugly.
  function is_file($server_src)
  { 
    $path = dirname($server_src);
    $list = $this->ls($path);
    if($list === false)
    {
      $this->error = 'Не могу получить список файлов';
      $this->logger->log('','ERROR', $this->error);
      return false;
    }
    foreach($list as $item)
      if( (rtrim($item['href'],'/')==rtrim($server_src,'/') ) && ($item['type']=='f') )
        return true;
    return false;
  }

  //Ugly. 
  function is_dir($server_src)
  { 
    $path = dirname($server_src);
    $list = $this->ls($path);
    if($list === false)
    {
      $this->error = 'Не могу получить список файлов';
      $this->logger->log('','ERROR', $this->error);
      return false;
    }
    foreach($list as $item)
      if( (rtrim($item['href'],'/')==rtrim($server_src,'/') ) && ($item['type']=='d') )
        return true;
    return false;
  }
}



?>