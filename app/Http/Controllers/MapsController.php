<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapsController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getData()
    {
        //DB queries and etc go here
        $location = DB::select('select * from testtable');
        //$location = "Leiria";
        return $location;
    }
}
