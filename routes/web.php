<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout')->middleware('auth');;

Route::get('/register', 'RegisterController@register');
Route::post('/register', 'RegisterController@register');
Route::get('/verify', 'RegisterController@verify')->middleware('auth');;
Route::get('/activate', 'RegisterController@activate');

Route::get('/dashboard', 'DashboardController@showDashboard')->middleware('auth');;
Route::get('/dashboard/profile', 'DashboardController@profile')->middleware('auth');;
Route::get('/dashboard/tables', 'DashboardController@tables')->middleware('auth');;
Route::get('/dashboard/notifications', 'DashboardController@notifications')->middleware('auth');;
Route::get('/dashboard/create', 'DashboardController@createUser')->middleware('auth');;
Route::post('/dashboard/create', 'DashboardController@createUser')->middleware('auth');;
Route::get('/user', function() {
    dd(Auth::user());
});
