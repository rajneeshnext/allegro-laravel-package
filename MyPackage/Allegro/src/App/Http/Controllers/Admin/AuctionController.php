<?php
//namespace App\Http\Controllers\Admin;
namespace MyPackage\allegro\App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MyPackage\allegro\App\Mylibs\AllegroAPi\Common;

class AuctionController extends Controller
{
	protected $common;

    public function __construct(Common $common)

    {
 		$this->common = $common;
    }



    public function index()
    {
    	//new ApiTest();
    	$data = array();
    	$data["auctions"] = $this->getlistingAuctions();
    	/*echo "<pre>";
    	print_r($data);
    	echo "</pre>";
    	die;*/
        return view('allegro::admin/my_auction',$data);
    }



    public function getlistingAuctions()

    {

    	$categories = $this->getCategories();

    	//  echo "<pre>";

    	//  print_r($categories);

    	//  echo "</pre>";

    	// die;

    	$action = "https://api.allegro.pl/offers/listing?category.id=11763";

		    	$method = "GET";

        		$auction =  $this->common->getAuction($action,$method);

        		return $auction;

    	$auction = array();

    	if(isset($categories->categories)){

	    	foreach($categories->categories as $cat){

		    	$action = "https://api.allegro.pl/offers/listing?category.id=".$cat->id;

		    	$method = "GET";

        		$auction[] =  $this->common->getAuction($action,$method);

		    }

		}

		return $auction;

	    //$action = "https://api.allegro.pl/sale/offers/7682368695";



    }



    public function getAuctions()

    {

	    $action = "https://api.allegro.pl/sale/offers/7682368695";

		$method = "GET";

        return $this->common->getAuction($action,$method);

    }



    public function getCategories()
    {

	    $action = "https://api.allegro.pl/sale/categories";

		$method = "GET";

        return $this->common->getCategory($action,$method);

    }



	

    public function createAuction(Request $request)
    {
    	$data = array();
    	$data["categories"] = $this->getCategories();
    	// echo "<pre>";

    	// print_r($data["categories"]);

    	// echo "</pre>";

    	// die;

        return view('allegro::admin/add_auction',$data);

    }

    public function addAuction(Request $request){
        $input = $request->all();
        if($input){
                $action = "https://api.allegro.pl/sale/offers";
                $method = "POST";
            $data = array(
                "name" => $input["auction_name"],
                "category" => ["id" => $input["category_id"]]
            ); 

            $result =  $this->common->addOffer($action,$method,$data);
            if(isset($result->errors)){
                echo $json_error = json_encode(array("error" => $result->errors[0]->userMessage));
            }else{
                echo $json_error = json_encode(array("error" => "0"));
            }
            
            
        }
    }



	

}

