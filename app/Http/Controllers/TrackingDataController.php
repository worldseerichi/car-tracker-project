<?php

namespace App\Http\Controllers;
use App\Models\TrackingData;
use Illuminate\Http\Request;

class TrackingDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alldata = TrackingData::all();
        return response()->json($alldata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newdata = new TrackingData([
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'altitude' => $request->get('altitude'),
            'bearing' => $request->get('bearing'),
            'velocity' => $request->get('velocity'),
            'gir_x' => $request->get('gir_x'),
            'gir_y' => $request->get('gir_y'),
            'gir_z' => $request->get('gir_z'),
            'acel_x' => $request->get('acel_x'),
            'acel_y' => $request->get('acel_y'),
            'acel_z' => $request->get('acel_z'),
            'device_id' => $request->get('device_id'),
        ]);
        $newdata->save();
        return response()->json('Tracking Data Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newdata = TrackingData::find($id);
        return response()->json($newdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newdata = TrackingData::find($id);
        $newdata->latitude = $request->get('latitude');
        $newdata->longitude = $request->get('longitude');
        $newdata->altitude = $request->get('altitude');
        $newdata->bearing = $request->get('bearing');
        $newdata->velocity = $request->get('velocity');
        $newdata->gir_x = $request->get('gir_x');
        $newdata->gir_y = $request->get('gir_y');
        $newdata->gir_z = $request->get('gir_z');
        $newdata->acel_x = $request->get('acel_x');
        $newdata->acel_y = $request->get('acel_y');
        $newdata->acel_z = $request->get('acel_z');
        //$newdata->device_id = $request->get('device_id');
;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newdata = TrackingData::find($id);
        $newdata->delete();

        return response()->json("Tracking Data Successfully Deleted");
    }
}
