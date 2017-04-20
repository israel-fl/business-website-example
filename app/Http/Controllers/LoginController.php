<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use Redirect;
use Auth;

class LoginController extends Controller {
    public function login(Request $request) {
        // determine whether to serve the view or post the login form
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email' => 'bail|required',  // bail = don't continue validation if missing
                'pass' => 'required'
            ]);

            $username = $request->input('email');

            $loginWasSuccessful = Auth::attempt([
                'email' => request('email'),
                'password' => request('pass') // we're comparing hashes
            ]);

            if ($loginWasSuccessful) {
                $user = Auth::user();
                if ($user->verified === "true") {
                    return redirect('/dashboard');
                } else {
                    return redirect('/verify');
                }
            } else {
                // doesn't exist
                return redirect('/login')
                    ->withInput()
                    ->withErrors("Email or password invalid");
            }

        } else {  // this is just a GET request, show the page
            return view('login.login');
        }
    }

     public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
