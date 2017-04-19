<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class DashboardController extends Controller
{
    public function showDashboard() {
        // get user here and and send it over
        $user = Auth::user();
        return view('dashboard', [
                'user' => $user,
            ]);
    }
}
