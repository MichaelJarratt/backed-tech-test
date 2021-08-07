<?php

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Please make BLOG & COMMENT CRUD ROUTES
*/

Route::get('/blogs', function() {
    $data = Blog::all();
    return $data;
});

Route::get('/blog/{$id}', function($id) {
    $blog = Blog::where('id',$id) -> get();
    return $blog;
});

Route::post('/blogsa', function() {
    return "hello";
});

Route::put('/blogsb', function() {
    return null;
});

Route::delete('/blogsc', function() {
    return null;
});
