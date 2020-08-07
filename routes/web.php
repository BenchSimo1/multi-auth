<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:admin');

    Route::namespace('Auth')->group(function () {

        //Login Routes
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        // password routes

        Route::prefix('/password')->name('password.')->group(function () {

            //Forgot Password Routes
            Route::get('/reset', 'ForgotPasswordController@showLinkRequestForm')->name('request');
            Route::post('/email', 'ForgotPasswordController@sendResetLinkEmail')->name('email');

            //Reset Password Routes
            Route::get('/reset/{token}', 'ResetPasswordController@showResetForm')->name('reset');
            Route::post('/reset', 'ResetPasswordController@reset')->name('update');
        });
    });
});
