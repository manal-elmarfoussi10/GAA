<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoseurController extends Controller
{
    public function index()
    {
        return view('dashboardposeur');
    }
}
