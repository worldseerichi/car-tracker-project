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
        /*if(Auth::id() == '' || Auth::id() == 1) { //stop admin user and unauthenticated users from accessing g-p-s route
            return 'No data found'; //remove this when we have functional middleware
        }
        //$rsu = Rsu::where('user_id', Auth::id())->get(); //doesnt work, see how to query table using foreign key below
        $rsu = User::with('rsu')->find(Auth::id())->rsu; //get rsu connected to the authenticated user

        $data = Rsu::with('trackingdata')->find($rsu['id'])->trackingdata->take(100);

        if(count($data) == 0){
            return 'No data found';
        };*/

        $data = TrackingData::get();

        if(count($data) == 0){
            return 'No data found';
        };

        return $data;
    }

    /*public function getAdjacentData(){
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
    }*/

    public function getToken(){
        return csrf_token();
    }

    public function postDataBatch(Request $request){
        $request->validate([
            'data.*.latitude' => 'required|numeric',
            'data.*.longitude' => 'required|numeric',
            'data.*.altitude' => 'required|numeric',
            'data.*.bearing' => 'required|numeric',
            'data.*.velocity' => 'required|numeric',
            'data.*.gir_x' => 'required|numeric',
            'data.*.gir_y' => 'required|numeric',
            'data.*.gir_z' => 'required|numeric',
            'data.*.acel_x' => 'required|numeric',
            'data.*.acel_y' => 'required|numeric',
            'data.*.acel_z' => 'required|numeric',
            'data.*.rsu_id' => 'required|numeric',
            'data.*.recorded_at' => 'required|date'
        ]);
        foreach ($request->get('data') as $data) {
            $this->create($data);
        }
        return 'Data added';
    }

    public function postData(Request $request){
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'altitude' => 'required|numeric',
            'bearing' => 'required|numeric',
            'velocity' => 'required|numeric',
            'gir_x' => 'required|numeric',
            'gir_y' => 'required|numeric',
            'gir_z' => 'required|numeric',
            'acel_x' => 'required|numeric',
            'acel_y' => 'required|numeric',
            'acel_z' => 'required|numeric',
            'rsu_id' => 'required|numeric',
            'recorded_at' => 'required|date'
        ]);
        Rsu::where('id', $request->get('rsu_id'))->firstOr(function () {
            return 'RSU not found';
        });
        $data = $request->only('latitude', 'longitude','altitude','bearing','velocity','gir_x','gir_y','gir_z','acel_x','acel_y','acel_z','rsu_id','recorded_at');
        $this->create($data);
        return 'Data added';
    }

    public function create(array $data)
    {
      return TrackingData::create([
        'latitude'      => $data['latitude'],
        'longitude'     => $data['longitude'],
        'altitude'      => $data['altitude'],
        'bearing'       => $data['bearing'],
        'velocity'      => $data['velocity'],
        'gir_x'         => $data['gir_x'],
        'gir_y'         => $data['gir_y'],
        'gir_z'         => $data['gir_z'],
        'acel_x'        => $data['acel_x'],
        'acel_y'        => $data['acel_y'],
        'acel_z'        => $data['acel_z'],
        'rsu_id'        => $data['rsu_id'],
        'recorded_at'   => $data['recorded_at']
      ]);
    }
}
