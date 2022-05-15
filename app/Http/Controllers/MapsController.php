<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index()
    {
        return view('dashboard'/*, ['location' => $location]*/);
    }

    public function getData()
    {
        //DB queries and etc go here
        $location = "Leiria";
        return $location;
    }
}
