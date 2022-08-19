<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function changeLanguage($lang)
    {
        Session::put('website_language', $lang);

        return Redirect::back();
    }
}
