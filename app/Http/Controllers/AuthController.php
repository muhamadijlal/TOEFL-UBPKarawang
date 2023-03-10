<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            if(Auth::user()->role == 'admin'){
                return redirect()->intended(route('admin.dashboard'));
            }
            else{
                return redirect()->intended(route('user.dashboard'));
            }
        }
        else
        {
            $response = Http::withHeaders([
                'Authorization' => 'd780SjadaKsWasREvWwa',
                'Content-Type' => 'application/json'
                ])
                ->post('https://api-gateway.ubpkarawang.ac.id/external/vaksin/get-user', [
                    'email' => $request->email,
                    'password' => $request->password,
                ]);               
        
            $data = json_decode($response->body());
            $user = $data->data;

            if($data->status_code == '000'){
                User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->status,
                    'password' => Hash::make($request->password),
                ]);

                if(Auth::attempt($credentials)){
                    if(Auth::user()->role == 'mahasiswa'){
                        $request->session()->regenerate();
                        return redirect()->intended(route('user.dashboard'));
                    }
                };
            }
            else
            {
                return back()->withErrors('Login gagal');
            }
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
