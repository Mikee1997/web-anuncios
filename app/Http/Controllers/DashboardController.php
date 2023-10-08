<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $anuncios=Anuncio::where('user_id',auth()->user()->id)->orderBy('updated_at','desc')->get();
        return view('dashboard',compact('anuncios'));
    }
}
