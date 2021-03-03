<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(["guest"]);
    }

    public function index(){
        return view("auth.login");
    }

    public function store(Request $request){
        // Validation
        $this->validate($request, [
            "email"=>"required|max:255",
            "password"=>"required|max:255",
        ]);

        // Signin
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }

        // Redirect
        return redirect()->route('dashboard');
    }
}
