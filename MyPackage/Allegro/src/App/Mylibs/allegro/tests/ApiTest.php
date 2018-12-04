	<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/Resource.php';
require_once dirname(__DIR__) . '/src/Api.php';

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    function get_redirect_target($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $headers = curl_exec($ch);
    curl_close($ch);
    // Check if there's a Location: header (redirect)
    if (preg_match('/^Location: (.+)$/im', $headers, $matches))
        return trim($matches[1]);
    // If not, there was no redirect so return the original URL
    // (Alternatively change this to return false)
    return $url;
}
// FOLLOW ALL REDIRECTS:
// This makes multiple requests, following each redirect until it reaches the
// final destination.
function get_redirect_final_target($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // follow redirects
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // set referer on redirect
    curl_exec($ch);
    $target = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    if ($target)
        return $target;
    return false;
}


    function testGetUri()
    {
            /*                      
$credentials = new Credentials(
    '8eda58eb6f044fbd81a20d629bf8af81',
    'PX5ehP7fXy59wH8H2mx5zMfMv0GxpDhOcdpY9b5Y8kYRWmtTwgn12u9zZ6Y3JrlS',
    'http://tivratech.in/hohmtech/ApiTest.php'
);
 */ 
        $clientId = "8eda58eb6f044fbd81a20d629bf8af81";
        $apiKey = "PX5ehP7fXy59wH8H2mx5zMfMv0GxpDhOcdpY9b5Y8kYRWmtTwgn12u9zZ6Y3JrlS";
        $redirectUri = "http://tivratech.in/hohmtech/ApiTest.php";

        $api = new Allegro\REST\Api($clientId, 'spam', $apiKey, $redirectUri);
        //$api = new Api($clientId, $clientSecret, $apiKey, $redirectUri, null, null);

        $url =  $api->getAuthorizationUri();
        echo file_get_contents($url);
        die;
        # example contents of your_redirect_uri.com/index.php
        $code = "sckQCE4urbXyKrnam4iNrYqj8m0GImcg";
        $response = $api->getNewAccessToken($code);
        echo "<pre>";
        print_R($response);
        die;
# response contains json with your access_token and refresh_token

       // $response =   $api->getUri();
       // $response =   $api->categories->getUri();
        $expected = 'https://allegro.pl/auth/oauth/authorize' .
                    "?response_type=code&client_id=$clientId" .
                    "&api-key=$apiKey&redirect_uri=$redirectUri";
         //echo $expected;
         
         ///https://allegro.pl/auth/oauth/authorize?response_type=code&client_id=8eda58eb6f044fbd81a20d629bf8af81&api-key=PX5ehP7fXy59wH8H2mx5zMfMv0GxpDhOcdpY9b5Y8kYRWmtTwgn12u9zZ6Y3JrlS&redirect_uri=http%3A%2F%2Ftivratech.in%2Fhohmtech%2FApiTest.php
         //https://allegro.pl/auth/oauth/authorize?response_type=code&client_id=8eda58eb6f044fbd81a20d629bf8af81&api-key=PX5ehP7fXy59wH8H2mx5zMfMv0GxpDhOcdpY9b5Y8kYRWmtTwgn12u9zZ6Y3JrlS&redirect_uri=http://tivratech.in/hohmtech/ApiTest.php
         die;           

        $response = $this->assertEquals($expected, $api->getAuthorizationUri());

    /*  $response =   $this->assertEquals('https://allegroapi.io', $api->getUri());

        $response =   $this->assertEquals('https://allegroapi.io/categories',$api->categories->getUri());

        $response =   $this->assertEquals('https://allegroapi.io/categories/12',$api->categories(12)->getUri());*/

        print_R($response);
    }

    function getPage ($url) {
        // POST Request Access Token 
           //response_type=code&client_id=8eda58eb6f044fbd81a20d629bf8af81&redirect_uri=http://tivratech.in/hohmtech/ApiTest.php
 
        $fields = array(
            'response_type' => "code",
            'client_id' => "8eda58eb6f044fbd81a20d629bf8af81",
            'redirect_uri' => "http://tivratech.in/hohmtech/ApiTest.php",
            'scope' => "public read write"
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://allegro.pl/auth/oauth/authorize',
          CURLOPT_RETURNTRANSFER => TRUE,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "content-type: application/json"
          )
        ));

        $json_response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode( $json_response, TRUE );
        print_r($response);
        die;

}

    /**
     * @dataProvider credentialsProvider
     */
    function testAuthorization($clientId, $clientSecret, $apiKey,
                               $redirectUri, $accessToken, $refreshToken)
    {
        $api = new Allegro\REST\Api($clientId, $clientSecret, $apiKey,
                                    $redirectUri, $accessToken, $refreshToken);
						

        $expected = 'https://ssl.allegro.pl/auth/oauth/authorize' .
                    "?response_type=code&client_id=$clientId" .
                    "&api-key=$apiKey&redirect_uri=$redirectUri";

        $this->assertEquals($expected, $api->getAuthorizationUri());

        $this->assertEquals($accessToken, $api->getAccessToken());
        $this->assertEquals($accessToken, $api->categories->getAccessToken());
        $this->assertEquals($accessToken, $api->categories(123)->getAccessToken());

        $this->assertEquals($apiKey, $api->getApiKey());
        $this->assertEquals($apiKey, $api->categories->getApiKey());
        $this->assertEquals($apiKey, $api->categories(123)->getApiKey());
    }

    function credentialsProvider()
    {
        return array(
            array('eggs', 'spam', 'ham', 'beans', null, null),
            array('wood', 'stone', 'clay', 'wool', 'wheat', 'depleted uranium'),
            array('white', 'blue', 'black', 'red', 'green', 'colorless')
        );
    }
}

$function = new ApiTest();
//echo $function->testGetUri();
echo $function->get_redirect_final_target("https://allegro.pl/auth/oauth/authorize?response_type=code&client_id=8eda58eb6f044fbd81a20d629bf8af81&redirect_uri=http://tivratech.in/hohmtech/ApiTest.php");
