<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }


    public function googleAuth()
    {
        return Socialite::driver('google')->redirectUrl(config('services.google.redirect_1'))->redirect();
    }

    // public function googleAuthUser()
    // {
    //     return Socialite::driver('google')->redirectUrl(config('services.google.redirect_2'))->redirect();
    // }

    // public function processLoginUser(){
    //     return redirect()->route('user.login')->with('invalidLogin', 'You are not an admin');
    // }

    public function processLogin(){
        $user = Socialite::driver('google')->redirectUrl(config('services.google.redirect_1'))->stateless()->user();
        $admin = Admin::with(['role'])->where('email', $user->email)->first();

        if($admin){
            session()->put('id', $admin->id);
            session()->put('email', $admin->email);
            session()->put('name', $admin->name);
            session()->put('role', $admin->role->name);

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login Success');
        }

        return redirect()->route('admin.login')->with('invalidLogin', 'You are not an admin');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('admin.login')->with('logout', 'Logout success!');
    }
}
