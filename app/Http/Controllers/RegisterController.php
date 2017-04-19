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
                'pass' => 'required',
            ]);

            try {
                $email = request('email');
                $name = request('name');
                $pass = request('pass');
                // dd($email, $name, $pass);
                // check if the email is already in the database
                $exists = User::find($email);
                if ($exists === NULL) {
                    $user = new User;
                    $user->name = $name;
                    $user->email = $email;
                    $user->password =  Hash::make($pass);  // we're storing hashes of the passwords
                    $user->level = 1;  // every new user is level 1, admins are assigned in registerAdmin
                    $user->save();
                    $token = sendEmail($user); // return the redirect request
                    return redirect()->route('verify', [$user, $token]);
                } else {
                    return redirect('/register')
                        ->withInput()
                        ->withErrors("There is already an account associated with that email.");
                }
            } catch (QueryException $e) {
                    dd($e);
                    // something went wrong
                    return redirect('/register')
                        ->withInput()
                        ->withErrors("There was an error processing your request");
            }
        } else {  // this is just a GET request, show the page
            return view('register');
        }
    }

    public function verify($user) {
        // determine whether to serve the view or post the login form
        if ($request->isMethod('post')) {
            return verifyEmailRequest($user); // return the redirect request
        } else {
            // if you are doing a get you must have a token
            if ($token === "") {
                return redirect('/login'))
            }
            return view('verify', [
                    'token' => $token,
                    'email' =>
                ]);
        }
    }

    private function sendEmail($user) {

        $token = str_random(10); // produce a token of 10 chars
        $verifyEmailRequest = new VerifyEmailRequest;
        $verifyEmailRequest->token = Hash::make($token);  // store a hashed token
        $verifyEmailRequest->userId = $user->id;
        $timeNow = Carbon\Carbon::now();  // get the time
        $verifyEmailRequest->created = $timeNow;
        $verifyEmailRequest->save();

        $data = array('name'=>"Virat Gandhi");

        Mail::send('mail', $data, function($message) {
         $message->to($user->email, 'Tutorials Point')->subject
            ('Verify your email with Data Rhino:');
         $message->from('data.rhino@israelfl.com','Data Rhino');
        });

        return $token;
   }
}
