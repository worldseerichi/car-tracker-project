<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Device;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::withTrashed()->all();
        //return response()->json($users);*/

        return response()->json($users);
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
        $user = new User([
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ]);
        $user->save();
        return response()->json('User Successfully Added');
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
        $user = User::find($id);
        return response()->json($user);
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
        $user = User::find($id);
        $user->username = $request->get('username');
        $user->password = $request->get('password');
        //$user->is_admin = $request->get('is_admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $devices = Device::where('user_id', $id)->get();
        $user->delete();
        foreach ($devices as $device) {
            $device->delete();
        }


        return "User Successfully Deleted";
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        $devices = Device::withTrashed()->where('user_id', $id)->get();
        foreach ($devices as $device) {
            $device->restore();
        }
        return "User Sucessfully Restored";
    }
     /**
     * restore all post
     *
     * @return response()
     */
    public function restoreAll()
    {
        User::onlyTrashed()->restore();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        User::where('id', $id)->withTrashed()->forceDelete();

        return "shitbro";
    }
}
