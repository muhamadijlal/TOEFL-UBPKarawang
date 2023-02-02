<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index(){
        return view('layouts.auth.login');
    }

    public function autentication(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role == 0){
                return redirect()->intended(route('admin.dashboard'));
            }
            else{
                return redirect()->intended(route('user.dashboard'));
            }
        }
        // else
        // {
        //     $response = Http::withHeaders([
        //         'Authorization' => '11111',
        //         'Content-Type' => 'application/json'
        //     ])
        //     ->post('url',[
        //         'email' => '',
        //         'password' => '',
        //     ]);

        //     $data = json_decode($response->body());
        //     $user = $data->data;
        // }

        return back()->withErrors('Login Gagal!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
