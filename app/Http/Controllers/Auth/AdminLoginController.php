<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AdminLoginController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('auth.adminlogin');
    }

    public function login(Request $request){
        $valid = $request->validate([
            'email'=>'required|string|email|exists:admins',
            'password'=>'required|string|min:8'
        ]);

        if(Auth::guard('admin')->attempt(['email'=> $request->email , 'password'=> $request->password],$request->remember)){
            // if Successful then redirect to intended route or admin dashboard
            return redirect()->intended(route('admin.home'));
        }

        // if Unsuccess then back to admin-login

        return redirect()->back()->withInput()
        ->withErrors([
            'password' => 'Incorrect password!'
        ]);
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }
    
}
