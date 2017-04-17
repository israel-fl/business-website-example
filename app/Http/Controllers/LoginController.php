<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Redirect;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        // determine whether to serve the view or post the login form
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'bail|required',  // bail = don't continue validation if missing
                'pass' => 'required'
            ]);

            $username = $request('email');

            $loginWasSuccessful = Auth::attempt([
                'email' => request('email'),
                'password' => Hash::make($request_>input('pass')) // we're comparing hashes
            ]);

            $password = Hash::make($request_>input('pass'));  // we're comparing hashes

            if ($loginWasSuccessful) {
                return redirect('/console');
            } else {
                // doesn't exist
                return view('login')
                    ->withInput()
                    ->withErrors("Email or password invalid");
            }

        } else {  // this is just a GET request, show the page
            return view('login');
        }
    }

     public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
