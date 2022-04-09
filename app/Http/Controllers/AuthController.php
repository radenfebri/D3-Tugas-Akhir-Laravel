<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $ip = $request->post('ip');
        $user = $request->post('user');
        $password = $request->post('password');

        $data = [
            'ip' => $ip,
            'user' => $user,
            'password' => $password,
        ];

        $request->session()->put($data);

        return redirect('dashboard');
    }


    public function logout()
    {
        session()->forget('ip');
        session()->forget('user');
        session()->forget('password');

        return redirect('login');
    }
}
