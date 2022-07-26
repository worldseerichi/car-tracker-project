<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Device;
use App\Models\TrackingData;
use \DateTime;

class MapsController extends Controller
{
    public function index()
    {
        $apiKey = config('services.google.key');

        return view('dashboard', ['apiKey' => $apiKey]);
    }

    public function getData()
    {
        $validDevices = Device::pluck('id')->toArray();
        $data = TrackingData::whereIn('device_id', $validDevices)->get();

        if(count($data) == 0){
            return 'No data found';
        };

        return $data;
    }

    public function getDataFiltered(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'range' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $locationCheck = preg_match('/^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/i', $request->input('location'));
        if (!$locationCheck) {
            return 'Invalid location. Ensure it is in the format "lat,lng" and that the coordinates are valid.';
        }
        $location = explode(',', $request->input('location'));

        $range = $request->input('range');
        if ($range <= 0) {
            return 'Invalid range. Ensure it is greater than 0.';
        }

        $start = new DateTime($request->input('start_date'));
        $end = new DateTime($request->input('end_date'));

        $validDevices = Device::pluck('id')->toArray();

        $data = TrackingData::whereIn('device_id', $validDevices)->whereBetween('recorded_at', [$start, $end])->get();
        if(count($data) == 0){
            return 'No data found between given dates.';
        };
        $devices = TrackingData::whereIn('device_id', $validDevices)->select('device_id')->distinct()->get();
        $deviceData = [];

        foreach ($devices as $value) {
            $deviceData[$value['device_id']] = $data->filter(function($data) use ($value)
            {
               return $data->device_id == $value['device_id'];
            });
        };

        $earthRadius = 6371000; //meters

        foreach ($deviceData as $key => $values) {
            $shortestDistance = 6371000;
            foreach ($values as $data) {
                $latFrom = deg2rad(floatval($location[0]));
                $lonFrom = deg2rad(floatval($location[1]));
                $latTo = deg2rad($data->latitude);
                $lonTo = deg2rad($data->longitude);

                $latDelta = $latTo - $latFrom;
                $lonDelta = $lonTo - $lonFrom;

                $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                $distance = $angle * $earthRadius; //haversine formula
                if ($distance < $shortestDistance) {
                    $shortestDistance = $distance;
                }
            }
            if ($shortestDistance > $range) {
                unset($deviceData[$key]);
            }
        }
        if(empty($deviceData)){
            return 'No data found within given range.';
        }
        return $deviceData;
    }

    public function getDataFilteredExport($location, $range, $start_date, $end_date)
    {
        $locationCheck = preg_match('/^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/i', $location);
        if (!$locationCheck) {
            echo 'Invalid location. Ensure it is in the format "lat,lng" and that the coordinates are valid.';
        }
        $location = explode(',', $location);

        if ($range <= 0) {
            echo 'Invalid range. Ensure it is greater than 0.';
        }

        $start = new DateTime($start_date);
        $end = new DateTime($end_date);

        $validDevices = Device::pluck('id')->toArray();

        $data = TrackingData::whereIn('device_id', $validDevices)->whereBetween('recorded_at', [$start, $end])->get();
        if(count($data) == 0){
            echo 'No data found between given dates.';
        };
        $devices = TrackingData::whereIn('device_id', $validDevices)->select('device_id')->distinct()->get();
        $deviceData = [];

        foreach ($devices as $value) {
            $deviceData[$value['device_id']] = $data->filter(function($data) use ($value)
            {
               return $data->device_id == $value['device_id'];
            });
        };

        $earthRadius = 6371000; //meters

        foreach ($deviceData as $key => $values) {
            $shortestDistance = 6371000;
            foreach ($values as $data) {
                $latFrom = deg2rad(floatval($location[0]));
                $lonFrom = deg2rad(floatval($location[1]));
                $latTo = deg2rad($data->latitude);
                $lonTo = deg2rad($data->longitude);

                $latDelta = $latTo - $latFrom;
                $lonDelta = $lonTo - $lonFrom;

                $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                $distance = $angle * $earthRadius; //haversine formula
                if ($distance < $shortestDistance) {
                    $shortestDistance = $distance;
                }
            }
            if ($shortestDistance > $range) {
                unset($deviceData[$key]);
            }
        }
        if(empty($deviceData)){
            echo 'No data found within given range.';
        }
        $exportData = [];
        foreach ($deviceData as $key => $values) {
            $exportData['Device ID '.$key] = [];
            foreach ($values as $data) {
                array_push($exportData['Device ID '.$key], $data);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($exportData, JSON_PRETTY_PRINT);
    }

    public function getDataCounted(){
        //amount TrackingData::count();
        $QntOfDataAPI = [];
        $devices = Device::withTrashed()->get();
        $devicesCounter = count(TrackingData::select('device_id')->distinct()->get());
        $data = TrackingData::get();
        if(count($data) == 0){
            return 'No data found';
        };
        if($devicesCounter==0){
            $QntOfDataAPI = "Empty";
        }else{
            for ($i = 1; $i <= $devicesCounter; $i++) {
                $QntOfDataAPI[$i] = count(TrackingData::where("device_id", $i )->get());
            }
        }


        $users = User::withTrashed()->where('is_admin', 0)->get();
        return array('requestamounts' => array($QntOfDataAPI), 'devices' => $devices, 'users' => $users);
    }


    public function getToken(Request $request){
        //return csrf_token();
        return $request->session()->token();
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
            'data.*.device_id' => 'required|numeric',
            'data.*.recorded_at' => 'required|date'
        ]);
        Device::where('id', $request->get('device_id'))->firstOr(function () {
            return 'User deactivated or Device not found';
        });
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
            'device_id' => 'required|numeric',
            'recorded_at' => 'required|date'
        ]);
        Device::where('id', $request->get('device_id'))->firstOr(function () {
            return 'User deactivated or Device not found';
        });
        $data = $request->only('latitude', 'longitude','altitude','bearing','velocity','gir_x','gir_y','gir_z','acel_x','acel_y','acel_z','device_id','recorded_at');
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
        'device_id'        => $data['device_id'],
        'recorded_at'   => $data['recorded_at']
      ]);
    }

    public function postDataTesting(Request $request){
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'device_id' => 'required|numeric'
        ]);
        Device::where('id', $request->get('device_id'))->firstOr(function () {
            return 'User deactivated or Device not found';
        });
        $data = $request->only('latitude', 'longitude','device_id');
        TrackingData::create([
            'latitude'      => $data['latitude'],
            'longitude'     => $data['longitude'],
            'device_id'     => $data['device_id']
        ]);
        return 'Data added';
    }
}
