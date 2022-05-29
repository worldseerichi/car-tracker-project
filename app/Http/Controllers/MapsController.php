<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rsu;
use App\Models\TrackingData;

class MapsController extends Controller
{
    public function index()
    {
        $apiKey = config('services.google.key');

        return view('dashboard', ['apiKey' => $apiKey]);
    }

    public function getData()
    {

        //DB queries and etc go here
        if(Auth::id() == '' || Auth::id() == 1) { //stop admin user and unauthenticated users from accessing g-p-s route
            return 'No data found'; //remove this when we have functional middleware
        }
        //$rsu = Rsu::where('user_id', Auth::id())->get(); //doesnt work, see how to query table using foreign key below
        $rsu = User::with('rsu')->find(Auth::id())->rsu; //get rsu connected to the authenticated user

        $data = Rsu::with('trackingdata')->find($rsu['id'])->trackingdata->take(100);

        if(count($data) == 0){
            return 'No data found';
        };

        return $data;
    }

    public function getAdjacentData(){
        $rsu = User::with('rsu')->find(Auth::id())->rsu;

        $data = TrackingData::orderBy('id', 'DESC')->get();

        if(count($data) == 0){
            return 'No data found';
        };
        //var_dump($data);

        $filteredData = $data->filter(function($item) use($rsu) { //removes data from authenticated user
            return $item->rsu_id != $rsu['id'];
        });
        if(count($filteredData) == 0){
            return 'No data found';
        };
        $uniqueRsus = [];
        $lastCoordsRsus = $filteredData->filter(function($data) use (&$uniqueRsus) //gets last data from each user
        {
            $duplicate = in_array($data->rsu_id, $uniqueRsus);
            if(!$duplicate) {
                $uniqueRsus[] = $data->rsu_id;
            }
            return !$duplicate;
        })->values();
        return $lastCoordsRsus;
    }
}
