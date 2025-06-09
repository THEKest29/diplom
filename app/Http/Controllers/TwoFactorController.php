<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCode;

class TwoFactorController extends Controller
{
    public function show2FAForm()
    {
        $this->send2FACode();
        return view('/2fa');
    }

    public function verify2FA(Request $request)
    {
        $request->validate([
            '2fa_code' => 'required|numeric|digits:6',
        ]);

        if ($request->input('2fa_code') == session('2fa_code')) {
            session()->forget('2fa_code');
            // Логика успешной проверки кода
            return redirect()->route('home');
        }

        return back()->withErrors(['2fa_code' => 'Неверный код подтверждения.']);
    }

    public function send2FACode()
    {
        $code = rand(100000, 999999);
        session(['2fa_code' => $code]);

        // Отправка кода на email
        Mail::to(auth()->user()->email)->send(new TwoFactorCode($code));
    }
}

