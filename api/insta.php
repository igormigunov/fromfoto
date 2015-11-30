<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<html>
  <head></head>
  <body>  
    <h1>Popular on Instagram</h1>  
    <?php

    require_once $_SERVER["DOCUMENT_ROOT"].'/lib/Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Http_Client');


    $CLIENT_ID = '7948a86cfb9f4bf0b0e1645682faee5f';
    $CLIENT_SECRET = 'da2bd1219555430bbbb5d6afef3783ce';

    try {

      $client = new Zend_Http_Client('https://api.instagram.com/v1/media/popular');
      $client->setParameterGet('client_id', $CLIENT_ID);


      $response = $client->request();
      $result = json_decode($response->getBody());

   
      $data = $result->data;  
      if (count($data) > 0) {
        echo '<ul>';
        foreach ($data as $item) {
          echo '<li style="display: inline-block; padding: 25px"><a href="' . 
            $item->link . '"><img src="' . $item->images->thumbnail->url . 
            '" /></a> <br/>';
          echo 'By: <em>' . $item->user->username . '</em> <br/>';
          echo 'Date: ' . date ('d M Y h:i:s', $item->created_time) . '<br/>';
          echo $item->comments->count . ' comment(s). ' . $item->likes->count . 
            ' likes. </li>';
        }
        echo '</ul>';
      }

    } catch (Exception $e) {
      echo 'ERROR: ' . $e->getMessage() . print_r($client);
      exit;
    }
    ?>
  </body>
</html>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>