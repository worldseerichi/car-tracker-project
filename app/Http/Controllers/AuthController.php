<?php

namespace App\Http\Controllers;

use App\Models\Rsu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginRequest(Request $request)
    {
        $redir = 'login';
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        //$credentials = $request->only('username', 'password');
        if (Auth::attempt(['username' => $username, 'password' => $password, 'is_admin' => 1])) {
            $request->session()->regenerate();
            $redir = '/';
        }

        return $redir;
    }


    public function registrationRequest(Request $request)
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return 'You are not allowed to register accounts';
        }
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:4',
        ]);

        $userCheck = User::where('username', $request->get('username'))->firstOr(function () {
            return 'Not found';
        });

        if($userCheck != 'Not found'){
            return 'User already exists';
        }

        $data = $request->only('username', 'password');
        $check = $this->create($data);
        Rsu::create(['user_id' => $check['id']]);

        return 'User created';
    }

    public function currentUser(Request $request)
    {
      return $request->user();
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

        //return Redirect('dashboard');
    }
}
