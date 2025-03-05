<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function signin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect('/login')->with('msg', 'Ax katkhrb9 ?');
        }
    }


    public function show() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('user')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        Auth::login($user);
        return redirect('dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
