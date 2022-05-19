<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RsuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rsus = Account::all();
        return response()->json($rsus)
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
        $rsu = new Rsu([
            'id' => $request->get('id'),
            'range' => $request->get('range'),
            'description' => $request->get('description'),
            'user_id' => $request->get('user_id')
        ]);
        $rsu->save();
        return response()->json('RSU Successfully Added')
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
        $rsu = Account::find($id);
        return response()->json($rsu)
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
        $rsu = Rsu::find($id);
        $rsu->id = $request->get('id')
        $rsu->range = $request->get('range')
        $rsu->description = $request->get('description')
        $rsu->user_id = $request->get('user_id')
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rsu = Rsu::find($id);
        $rsu->delete();

        return response()->json("Rsu Successfully Deleted")
    }
}
