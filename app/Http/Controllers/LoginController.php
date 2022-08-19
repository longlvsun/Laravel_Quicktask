<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return Redirect::route('home');
        }

        return view('form.login');
    }

    public function login(LoginRequest $request)
    {
        $login = $request->only(['email', 'password']);

        if (Auth::attempt($login, isset($request->remember))) {
            return Redirect::route('home');
        }

        return Redirect::back()->withErrors(trans('auth.failed'));
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('login');
    }
}
