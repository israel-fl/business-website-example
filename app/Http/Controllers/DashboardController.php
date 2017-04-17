<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class DashboardController extends Controller
{
    public function showDashboard() {

        return view('dashboard');
    }
}
