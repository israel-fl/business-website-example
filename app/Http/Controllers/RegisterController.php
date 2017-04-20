<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\VerifyEmailRequest;
use Carbon\Carbon;
use Redirect;
use Auth;
use Illuminate\Database\QueryException;
use Mail;
use DB;

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
                $user = User::firstOrNew([
                        'email' => $email
                    ]);

                if ($user->exists) {
                    return redirect('/register')
                        ->withInput()
                        ->withErrors("There is already an account associated with that email");
                }

                $user->name = $name;
                $user->email = $email;
                $user->password =  Hash::make($pass);  // we're storing hashes of the passwords
                $user->level = 1;  // every new user is level 1, admins are assigned in registerAdmin
                $user->save();

                $loginWasSuccessful = Auth::attempt([
                    'email' => $email,
                    'password' => $pass // we're comparing hashes
                ]);
                if ($loginWasSuccessful) {
                    $this->sendEmail();
                    return redirect('/verify');
                } else {
                    return redirect('/register')
                        ->withErrors("There was an error processing your request");
                }
            } catch (QueryException $e) {
                    dd($e);
                    // something went wrong
                    return redirect('/register')
                        ->withInput()
                        ->withErrors("There was an error processing your request");
            }
        } else {  // this is just a GET request, show the page
            return view('register.register');
        }
    }

    public function verify(Request $request) {

        // determine whether to serve the view or post the login form
        if ($request->isMethod('post')) {
            $this->sendEmail();
            return redirect('/verify')
                ->with('successStatus', 'Email resent');
        } else {
            $user = Auth::user();  // object must exist because of middleware
            // user is not verified, display verfified page
            return view('register.verify', [
                'user' => $user,
            ]);
        }


    }

    public function activate(Request $request) {
        try {
            $token = $request->token;
            $userId = DB::table('verify_email_requests')
                    ->select('user_id')
                    ->where('token', '=', hash('sha256', $token))
                    ->first();
            if (empty((array)$userId)) { // check if the token exists
                abort(404, 'Unauthorized action');
            }
            $userId = $userId->user_id;
            // hash was found, now verify user
            $user = User::find($userId);
            $user->verified = 'true';
            $user->save();

            if (Auth::check()) {
                // The user is logged in, log him out to reinitate session
                Auth::logout();
            }
            return view('register.successfully_verified');
        } catch (QueryException $e) {
            dd(e);
            return redirect('/login')
                ->withErrors("There was an error processing your request");
        }
    }


    public function showPolicy() {
        return view('policies.policy');
    }


    public function showTerms() {
        return view('policies.terms');
    }


    private function sendEmail() {

        $user = Auth::user();
        $token = str_random(10); // produce a token of 10 chars
        $verifyEmailRequest = new VerifyEmailRequest;
        $verifyEmailRequest->token = hash('sha256', $token);  // encrypt the token, since Hashes are salted
        $verifyEmailRequest->user_id = $user->id;
        $timeNow = Carbon::now();  // get the time
        $verifyEmailRequest->created = $timeNow;
        $verifyEmailRequest->save();

        $url = "https://www.datarhino.ml/activate?token=".$token;

        $data = array( 'email' => $user->email, 'name' => $user->name, 'url' => $url);

        Mail::send('register.verify_email', $data, function($message) use ($data) {
            $message
                ->to($data['email'])
                ->subject('Verify your email with Data Rhino:')
                ->from('data.rhino@gmail.com','Data Rhino');
        });
   }
}
