<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($id){
        $user = User::with(['profile'])->findOrFail($id);
        return view('layouts.user.profile.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_handphone' => ['required','numeric','digits_between:12,15'],
            'semester' => ['required'],
            'program_studi' => ['required'],
        ]);

        ProfileUser::where('user_id', $id)->update([
            'no_handphone' => $request->no_handphone,
            'semester' => $request->semester,
            'program_studi' => $request->program_studi,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Profile berhasil diupdate');
    }
}
