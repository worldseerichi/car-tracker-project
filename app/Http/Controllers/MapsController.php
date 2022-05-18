<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $location = DB::select('select * from testtable');
        //$location = "Leiria";
        return $location;
    }
}
