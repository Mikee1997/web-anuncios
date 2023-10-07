<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('bienvenido'); 
    }

    public function about()
    {
        return view('sobre_nosotros');
    }
}
