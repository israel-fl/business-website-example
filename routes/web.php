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
Route::get('/register', 'RegisterController@register');
Route::post('/register', 'RegisterController@register');
Route::get('/verify', 'RegisterController@verify');
Route::get('/dashboard', 'DashboardController@showDashboard');
Route::get('/user', function() {
    dd(Auth::user());
});
