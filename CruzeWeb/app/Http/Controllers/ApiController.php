<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firebase\Connector as FirebaseConnector;

class ApiController extends Controller
{
    private $firebase;
    public function __construct() {
        $this->firebase = new FirebaseConnector();
    }

    public function searchWithPlate($plate){
        echo json_encode($this->firebase->search("registered" , "plate" , $plate), JSON_UNESCAPED_UNICODE); 
    }

    public function getCarCodes(){
        echo json_encode(array_values($this->firebase->getAll("carcodes")), JSON_UNESCAPED_UNICODE); 
    }

    public function getAgencies($mien){
        echo json_encode(array_values($this->firebase->getAll("agency/".$mien)), JSON_UNESCAPED_UNICODE); 
    }

    public function getPartners($mien){
        echo json_encode(array_values($this->firebase->getAll("partner/".$mien)), JSON_UNESCAPED_UNICODE); 
    }

    public function getInfo(){
        echo $this->firebase->getAll("info"); 
    }

    public function allPlate(){
        echo json_encode(array_values($this->firebase->getAll("registered")),JSON_UNESCAPED_UNICODE); 
    }

    public function createTicket(Request $res){
        $this->firebase->insert("pnd_verify" , $res->except('_token'));
    }

}
