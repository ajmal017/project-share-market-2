<?php

/* Here is where you can register web routes for your application. These
routes are loaded by the RouteServiceProvider within a group which
contains the "web" middleware group. Now create something great!*/




Route::get(
    '/', function () {
        return view('welcome');
    }
);

<<<<<<< HEAD
Route::get(
    '/landing', function () {
        return view('pages/landing');
    }
);

?>
=======
Route::get('/', function () {
  return view('welcome');
});
Route::get('/stockmarkettest', function () {
  return view('stockmarkettest');
});
>>>>>>> 1fedcde01774c0d4fc564f3e94f4bbeaea186ecf
