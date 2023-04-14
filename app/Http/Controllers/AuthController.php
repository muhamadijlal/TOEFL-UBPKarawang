<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
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

            if(isset($data->status_code) && $data->status_code = '000'){
                if(isset($data->success)){
                    $user = $data->data;
                    $userId = User::create([
                                'nama' => $user->name,
                                'email' => $user->email,
                                'role' => $user->status,
                                'password' => Hash::make($request->password),
                            ])->id;

                    ProfileUser::create([
                        'user_id' => $userId,
                        'nim' => $user->nim,
                    ]);

                    if(Auth::attempt($credentials)){
                        if(Auth::user()->role == 'mahasiswa'){
                            $request->session()->regenerate();
                            return redirect()->intended(route('user.dashboard'));
                        }
                    };
                }else{
                    return back()->withErrors($data->messages);
                }
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
