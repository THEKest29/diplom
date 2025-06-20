<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function destroy(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    return redirect('/')->with('success', 'Вы успешно вышли из системы.');
    }
}
