<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\SignupRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SignupController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return Redirect::route('home');
        }

        return view('form.signup');
    }

    public function signup(SignupRequest $req)
    {
        $login = $req->only(['email', 'password']);

        $user = $req->all();
        $user['password'] = Hash::make($user['password']);

        try {
            $user = User::create($user);
            $user->is_active = true;
            $user->save();
            Auth::attempt($login, isset($req->remember));

            return Redirect::route('home');
        } catch(Exception $exp) {
            return Redirect::back()->withErrors($exp);
        }
    }
}
