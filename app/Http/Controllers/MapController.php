<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function map() {
        return view('Maps.map');
    }

    public function map_user() {
        return view('Maps.user');
    }
}
