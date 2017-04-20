<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\PasswordReset;
use Carbon\Carbon;
use Mail;
use DB;


class ResetPasswordController extends Controller
{
        public function beginReset(Request $request) {
            if ($request->isMethod('post')) {
                $this->validate($request, [
                        'email' => 'bail|required',  // bail = don't continue validation if missing
                ]);
                $email = request('email');
                $user = User::where('email', $email)->first();
                if (!$user) {  // user not found
                    return redirect('/reset')
                        ->withErrors("Email not found");
                }
                $this->sendResetEmail($user);
                return view('login.email_sent');
            } else {
                return view('login.begin_reset');
            }
        }



        public function resetPassword(Request $request) {
             if ($request->isMethod('post')) {
                try {
                    $this->validate($request, [
                        'pass' => 'bail|required',  // bail = don't continue validation if missing
                        'retype' => 'required',
                    ]);

                    if (request('pass') != request('retype')) {
                        return redirect('/reset/verify')
                        ->withErrors("The passwords did not match");
                    }

                    $userId = request('user');
                    $user = User::find($userId);
                    $user->password = Hash::make(request('pass'));
                    $user->save();

                    return view('login.successful_reset');
                } catch (QueryException $e) {
                    dd(e);
                    return redirect('/reset/verify')
                        ->withErrors("There was an error processing your request");
                }
            } else {
                try {
                    $token = $request->token;
                    $email = DB::table('password_resets')
                            ->select('email')
                            ->where('token', '=', hash('sha256', $token))
                            ->first();
                    $email = $email->email;
                    // hash was found, now reset password
                    $user = User::where('email', $email)->first();
                    return view('login.reset_password', [
                            'user' => $user
                        ]);
                } catch (QueryException $e) {
                    dd(e);
                    return redirect('/login')
                        ->withErrors("There was an error processing your request");
                }
            }
    }


    private function sendResetEmail($user) {

        $token = str_random(10); // produce a token of 10 chars
        $resetPasswordRequest = new PasswordReset;
        $resetPasswordRequest->token = hash('sha256', $token);  // encrypt the token, since Hashes are salted
        $resetPasswordRequest->email = $user->email;
        $timeNow = Carbon::now();  // get the time
        $resetPasswordRequest->created_at = $timeNow;
        $resetPasswordRequest->save();

        $url = "https://www.datarhino.ml/reset/verify?token=".$token;

        $data = array( 'email' => $user->email, 'name' => $user->name, 'url' => $url);

        Mail::send('login.reset_password_email', $data, function($message) use ($data) {
            $message
                ->to($data['email'])
                ->subject('Data Rhino: Reset your password:')
                ->from('data.rhino@gmail.com','Data Rhino');
        });
   }

}
