<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginRequest(Request $request)
    {
        if (Auth::check()) {
            $this->signOut();
        }
        $redir = 'login';
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        //$credentials = $request->only('username', 'password');
        if (Auth::attempt(['username' => $username, 'password' => $password, 'is_admin' => 1, 'deleted_at' => null],true)) {
            $redir = '/';
        }

        return $redir;
    }

    public function loginRequestMobile(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_id'=> 'required'
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        if (Auth::attempt(['username' => $username, 'password' => $password, 'is_admin' => 0, 'deleted_at' => null])) {
            $user = User::where('username', $username)->first();
            $deviceCheck = Device::where('device_id', $request->input('device_id'))->first();
            if ($deviceCheck){
                return 'Device already registered';
            }
            $device = Device::where('device_id', $request->input('device_id'))->withTrashed()->first();
            if ($device && $user['id'] != $device['user_id']) {
                $device->restore();
                Device::where('device_id', $request->input('device_id'))->withTrashed()->update([
                    'user_id' => $user['id']
                ]);
                return 'Device registered to new user';
            }
            Device::create(['device_id' => $request->input('device_id'), 'user_id' => $user['id']]);
            return 'Device registered';
        }

        return 'Login failed';
    }

    public function loginRequestDeviceID(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
        ]);
        $device_id = $request->input('device_id');
        $device = Device::where('device_id', $device_id)->firstOr(function () {
            return 'Device not found';
        });
        if ($device != 'Device not found') {
            Auth::loginUsingId($device['user_id']);
            return 'Login success';
        }
        return $device;
    }

    public function registrationRequest(Request $request)
    {
        var_dump(Auth::guest());
        if (!Auth::check() || Auth::user()->is_admin == 0) {
            return 'You are not allowed to register accounts.';
        }
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:4',
        ]);

        $userCheck = User::where('username', $request->get('username'))->firstOr(function () {
            return 'Not found';
        });

        if($userCheck != 'Not found'){
            return 'Account already exists.';
        }

        $data = $request->only('username', 'password');
        $check = $this->create($data);
        //Device::create(['user_id' => $check['id']]);

        return 'Account registered.';
    }

    public function create(array $data)
    {
      return User::create([
        'username' => $data['username'],
        'password' => Hash::make($data['password'])
      ]);
    }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return 'Logged out';
    }
}
