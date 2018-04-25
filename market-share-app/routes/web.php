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
    '/landing', function () {
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
    '/signin', function () {
        return view('pages/signin');
    }
);

Route::get(
    '/signup', function () {
        return view('pages/signup');
    }
);

Route::get(
    '/search', function () {
        return view('pages/search');
    }
);

Route::get(
    '/confirmation', function () {
        return view('pages/confirmation');
    }
);

//Route::get('/buy', 'ShareTransactionController@getPurchaseinfo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/listing/minutely/{asx_code}', 'MarketDataController@intraDayStats');
Route::get('/listing/daily/{asx_code}', 'MarketDataController@dailyStats');
Route::get('/listing/weekly/{asx_code}', 'MarketDataController@weeklyStats');
Route::get('/listing/monthly/{asx_code}', 'MarketDataController@monthlyStats');
Route::get('/listing/companycode/{asx_code}', 'MarketDataController@getCompanyDetails');
Route::get('/listing/companyname/{asx_code}', 'MarketDataController@getCompanyName');

//Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::get('/listing/{symbol}', 'ListingsController@listing');
//Route::get('/testing/buy-shares/{balance}', 'ShareTransactionController@balance');
Route::get('/testing/buy-shares/', 'ShareTransactionController@balance');

Route::get('/community/{fid}', 'FriendController@insertFriend');
