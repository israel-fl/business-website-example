<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use Redirect;
use Auth;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    public function register(Request $request) {
        // determine whether to serve the view or post the login form
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'bail|required',  // bail = don't continue validation if missing
                'email' => 'bail|required',
                'pass' => 'bail|required',
            ]);

            try {
                $email = request('email');
                // check if the email is already in the database
                $exists = User::find($email)->first();
                if (is_null($exists)) {

                        $user = new User;
                        $user->name = request('name');

                        $user->password =  Hash::make(request('pass'));  // we're storing hashes of the passwords
                        $user->level = 1;  // every new user is level 1, admins are assigned in registerAdmin
                        $user->save();

                        return redirect('/verify');
                } else {
                    return redirect('/register')
                        ->withInput()
                        ->withErrors("There is already an account associated with that email.");
                }
            } catch (QueryException $e) {
                        // something went wrong
                        return redirect('/register')
                            ->withInput()
                            ->withErrors("There was an error processing your request");
            }
        } else {  // this is just a GET request, show the page
            return view('register');
        }
    }

    public function verify() {
        return view('verify');
    }

    private function sendEmail($username){
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
         $message->to($username->email, 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
   }
}
