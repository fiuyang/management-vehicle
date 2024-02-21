<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($id) {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }

    public function profile(Request $request, $id)
    {
        $user = User::findOrfail($id);
        
        $request->validate([
            'username' => 'nullable',
            'password' => 'required|same:confirm_password',
        ]);
       
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Profil berhasil diubah');
    }
}
