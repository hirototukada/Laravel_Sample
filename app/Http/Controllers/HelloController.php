<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(){

        $date = config('ini.map_turn');



        return view('hello');
    }
}
