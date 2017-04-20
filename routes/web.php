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
Route::get('/logout', 'LoginController@logout')->middleware('login.required');;

Route::get('/register', 'RegisterController@register');
Route::post('/register', 'RegisterController@register');
Route::get('/verify', 'RegisterController@verify')->middleware('login.required');
Route::post('/verify', 'RegisterController@verify')->middleware('login.required');
Route::get('/activate', 'RegisterController@activate');
Route::get('/policy', "RegisterController@showPolicy");
Route::get('/terms', "RegisterController@showTerms");

Route::get('/dashboard', 'DashboardController@showDashboard')->middleware('verified.required');
Route::get('/dashboard/profile', 'DashboardController@profile')->middleware('verified.required');
Route::get('/dashboard/tables', 'DashboardController@tables')->middleware('verified.required');
Route::get('/dashboard/notifications', 'DashboardController@notifications')->middleware('verified.required');
Route::get('/dashboard/create', 'DashboardController@createUser')->middleware('verified.required');
Route::post('/dashboard/create', 'DashboardController@createUser')->middleware('verified.required');


Route::get('/reset', 'ResetPasswordController@beginReset');
Route::post('/reset', 'ResetPasswordController@beginReset');
Route::get('/reset/verify', 'ResetPasswordController@resetPassword');
Route::post('/reset/verify', 'ResetPasswordController@resetPassword');
