<?php

namespace MyPackage\allegro\App\Mylibs\AllegroAPi;

// require_once dirname(__DIR__) . '/AllegroAPi/vendor/autoload.php';

// require_once dirname(__DIR__) . '/AllegroAPi/src/Resource.php';

// require_once dirname(__DIR__) . '/AllegroAPi/src/Api.php';



// use PHPUnit\Framework\TestCase;

class Common {

    protected $clientId;
    protected $clientSecret;
    public function __construct($clientId = "",$clientSecret = "")
    {
      $this->clientId = config('app.clientID');
      $this->clientSecret = config('app.clientSecret');
    }


    function curlRequest($action,$method,$body = ""){
     // echo "----here---";
      $config = array();
      $config = app('db')->table('credentials')->whereId(1)->first();
      
      if(!empty($config) > 0){
        $data =  json_decode($config->response);
        $access_token = $data->access_token;
        $authorization = 'Bearer '.$access_token; 
      }else{
        $access_token = 0;
      }

      if(!empty($access_token)){
    	$this_headers = array('Host: allegro.pl',
                      'accept: application/vnd.allegro.public.v1+json',
                      'content-type: application/vnd.allegro.public.v1+json',
                      'Authorization: '.$authorization);
      if(!empty($body)){
    			$json = json_encode($body);
      }else{
          $json = "";
      }
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $action);    
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);    
					curl_setopt($curl, CURLOPT_HTTPHEADER, $this_headers);
					curl_setopt($curl, CURLOPT_CUSTOMREQUEST,$method);
					if($method == "POST"){
            if(!empty($body)){
						  curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            }
					}
          if($method == "PUT"){
            if(!empty($body)){
             // curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            }
          }
					$json_response = curl_exec($curl);
					return json_decode($json_response);
        }else{
          echo "access_token expire!!";
          die;
        }
    }

    function newToken($action,$method){
      //30898e9ebc8d479da3a58d13d6036be2

        $authorization = base64_encode($this->clientId . ':' . $this->clientSecret);

        $this_headers = array(
            "Authorization: Basic $authorization",
            "Content-Type: application/x-www-form-urlencoded"
        );
            //$data_json = json_decode($json);
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, $action);    
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);    
          curl_setopt($curl, CURLOPT_HTTPHEADER, $this_headers);
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST,$method);
          if($method == "POST" || $method == "PUT"){
            //curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
          }
          $json_response = curl_exec($curl);
          curl_close($curl);
          return json_decode($json_response);
    }



    function getAuthToken($action,$method){
      return $this->newToken($action,$method);
    }


  function getAuction($action,$method) {
        return $this->curlRequest($action,$method);
  }
//addOffer
  function addOffer($action,$method,$data) {
    		return $this->curlRequest($action,$method,$data);
	}



    function getCategory($action,$method) {

		return $this->curlRequest($action,$method);

	}	

}

?>