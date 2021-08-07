<?php

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

// "/" is the default route just pointing to the server, no page/subdomain
Route::get('/', function () {
    return view('welcome'); //returns welcome.blade.php as default
});

Route::get('/test', function() {
    return view ('test');
});

Route::get('/about', function() {
    return view ('pages.about'); //directories seporated by periods
});
