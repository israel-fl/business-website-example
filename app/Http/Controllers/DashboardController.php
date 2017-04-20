<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function showDashboard() {
        // get user here and and send it over
        $user = Auth::user();
        return view('dashboard.dashboard', [
                'user' => $user,
            ]);
    }

    public function profile() {
        $user = Auth::user();
        return view('dashboard.user', [
                    'user' => $user
                ]);
    }

    public function tables() {
        $user = Auth::user();
        return view('dashboard.table', [
                'user' => $user,
            ]);
    }


    public function notifications() {
        $user = Auth::user();
        return view('dashboard.notifications', [
                'user' => $user,
            ]);
    }


    public function createUser(Request $request) {
        $user = Auth::user();
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
                    $user->level = 2;  // this endpoint creates admins
                    $user->save();
                }
                return redirect('/dashboard/create')
                    ->with('successStatus', 'Admin created successfully');
            } catch (QueryException $e) {
                dd($e);
                // something went wrong
                return redirect('/dashboard/create')
                    ->withInput()
                    ->withErrors("There was an error processing your request");
            }
        } else {  // this was a get request
            if ($user->level == 2) {
                return view('dashboard.create_user', [
                        'user' => $user,
                    ]);
            } else {
                return redirect('/dashboard');
            }
        }
    }
}
