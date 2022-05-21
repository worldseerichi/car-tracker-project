<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Account;
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

        $credentials = $request->only('username', 'password');
        /*if (Auth::attempt($credentials)) { //Auth is not working properly
            $redir = '/'
            return $redir;
        }*/

        return $redir;
    }


    public function registrationRequest(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:4',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('have signed-in');
    }


    public function create(array $data)
    {
      return Account::create([
        'name' => $data['username'],
        'password' => Hash::make($data['password'])
      ]);
    }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('dashboard');
    }
}
