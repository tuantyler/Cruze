<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firebase\Connector as FirebaseConnector;

class CruzeController extends Controller
{
    private $firebase;
    public function __construct() {
        $this->firebase = new FirebaseConnector();
    }

    public function index(){
        $pending_verification = $this->firebase->getAll("pnd_verify");
        return view("index" , compact("pending_verification"));
    }

    public function denyTicket($ticket){
        $this->firebase->delete("pnd_verify/" . $ticket);
        return redirect()->back();
    }
    public function acceptTicket($ticket){
        $this->firebase->insert("registered" , $this->firebase->getAll("pnd_verify/" . $ticket));
        $this->firebase->delete("pnd_verify/" . $ticket);
        return redirect()->back();
    }

    public function registered(){
        $registered = $this->firebase->getAll("registered");
        return view("registered" , compact("registered"));
    }

    public function deleteVerifiedTicket($ticket){
        $this->firebase->delete("registered/" . $ticket);
        return redirect()->route("registered");
    }

    public function carCodes(){
        $carCodes = $this->firebase->getAll("carcodes");
        return view("carcodes" , compact("carCodes"));
    }

    public function createCarCode(Request $res){
        $this->firebase->insert("carcodes" , ["codename" => $res->codename , "codedes" =>  $res->codedes]);
        return redirect()->route("carCodes");
    }

    public function deleteCarCode($car_code) {
        $this->firebase->delete("carcodes/" . $car_code);
        return redirect()->route("carCodes");
    }

    public function createTicket(Request $res){
        $this->firebase->insert("pnd_verify" , $res->except('_token'));
        return redirect()->back();
    }

    public function agency(){
        $mienBac = $this->firebase->getAll("agency/mienbac");
        $mienTrung = $this->firebase->getAll("agency/mientrung");
        $mienNam = $this->firebase->getAll("agency/miennam");
        return view('agency' , compact('mienBac' , 'mienTrung' , 'mienNam'));
    }

    public function postAgency(Request $res){
        $this->firebase->insert("agency/" . $res->mien , $res->except('_token' , 'mien'));
        return redirect()->back();
    }

    public function deleteAgency($mien , $agency_id){
        $this->firebase->delete("agency/" . $mien . "/" . $agency_id);
        return redirect()->back();
    }

    public function partner(){
        $doXe = $this->firebase->getAll("partner/doxe");
        $baoHiem = $this->firebase->getAll("partner/baohiem");
        return view("partner" , compact("doXe" , "baoHiem"));
    }

    public function postPartner(Request $res){
        $this->firebase->insert("partner/" . $res->mien , $res->except('_token' , 'mien'));
        return redirect()->back();
    }

    public function deletePartner($mien , $agency_id){
        $this->firebase->delete("partner/" . $mien . "/" . $agency_id);
        return redirect()->back();
    }

    public function info(){
        $info = $this->firebase->getAll("info");
        return view("info" , compact("info"));
    }

    public function postInfo(Request $res){
        $this->firebase->createNew("/" , $res->except('_token'));
        return redirect()->back();
    }

    

}
