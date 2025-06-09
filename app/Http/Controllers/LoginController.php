<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show() {
        return view('login');
    }
    public function loginUser(Request $request) {
        $validated = $request->validate([
            'nick'=>'required',
            'password'=>'required',
        ]);

        if(Auth::attempt(['nick'=>$request->nick, 'password'=>$request->password])) {
            return redirect('/');
        }
        return redirect()->back()->withErrors([
            'nick'=>'неверный никнейм или пароль',
        ])->withInput();
    }
}
