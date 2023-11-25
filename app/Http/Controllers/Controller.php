<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function changeLanguage($locale)
    {
        // Verifica si el idioma es válido
        if (in_array($locale, ['en', 'es'])) {
            App::setLocale($locale);
            session()->put('language', $locale);
            // dd(App::getLocale());

        }

        // Redirige de nuevo a la página anterior
        return redirect()->back();//->back();
    }
}
