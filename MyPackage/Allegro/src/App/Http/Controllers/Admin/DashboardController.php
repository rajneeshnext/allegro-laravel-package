<?php

//namespace App\Http\Controllers\Admin;
namespace MyPackage\allegro\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MyPackage\allegro\App\Mylibs\AllegroAPi\Common;
use DB;
use App;

class DashboardController extends Controller
{
	protected $common;
    public function __construct(Common $common)
    {
    	$this->common = $common;
    }
	
    public function index()
    {
    	$result = $this->getAuthtoken();
    	if(!$result){
    		return view('allegro::admin/auth_token');
    	}else{
        	return view('allegro::admin/dashboard');
        }
    }

    public function getAuthtoken()
    {
    	if(isset($_GET["code"])){
    		$code = $_GET["code"];
    		$method = "POST";
    		$action = "https://allegro.pl/auth/oauth/token?grant_type=authorization_code&code=".$code."&redirect_uri=http://tivratech.in/allegro/public/admin/auth/token";
    		$response = $this->common->getAuthToken($action,$method);
    		if(isset($response->access_token)){
    			$date = date('Y-m-d H:i:s');	
    			$update = date('Y-m-d');	
    			$data["response"] = array(
    									"response" => json_encode($response),
    									"update_at" => $update
    								);
    			DB::table('credentials')->update($data["response"]);
    			return redirect('/');
		    }
    	}else{

    		$date = date('Y-m-d');
    		//$date = "2018-11-21";
    		$result = DB::table('credentials')
    		->where("update_at","=",$date)
    		->get();
    		if(count($result) > 0){
    			return true; 
    		}else{
    		//	echo "else";
    		}
    		// echo "111111here";
    		// die;
    	}
        return false;
    }

    public function getAuctions()
    {
	    $action = "https://api.allegro.pl/sale/offers/7682368695";
		$method = "GET";
        return $this->common->getAuction($action,$method);
    }
	
}
