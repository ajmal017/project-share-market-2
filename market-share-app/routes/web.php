<?php

/* Here is where you can register web routes for your application. These
routes are loaded by the RouteServiceProvider within a group which
contains the "web" middleware group. Now create something great!*/

Route::get(
    '/', function () {
        return view('pages/landing');
    }
);

Route::get(
    '/about', function () {
        return view('pages/about');
    }
);

Route::get(
    '/account', function () {
        return view('pages/account');
    }
);

Route::get(
    '/admin', function () {
        return view('pages/admin');
    }
);

Route::get(
    '/community', function () {
        return view('pages/community');
    }
);

Route::get(
    '/listing', function () {
        return view('pages/listing');
    }
);

Route::get(
    '/login', function () {
        return view('pages/login');
    }
);

Route::get(
    '/signup', function () {
        return view('pages/signup');
    }
);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@register');

