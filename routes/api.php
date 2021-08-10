<?php

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogAPIController;
use App\Http\Controllers\CommentAPIController;

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

//get all the fields from all the blogs
Route::get('/blogs', [BlogApiController::class, 'getAll']);

//get all the fields from a single blog by ID (in QueryString)
Route::get('/blog', [BlogApiController::class, 'getByIDQueryString']);

//alternate implementation of the API above. Did this after the update comment function and realised I could pass in the ID this way
Route::get('/blog/{id}', [BlogApiController::class, 'GetByID']);

//commit new comment to DB
Route::post('/comment', [CommentApiController::class, 'commitComment']);

//update comment
//the blog_id should not be updatable, since it wouldn't make sense to amend which blog a comment belonged to
Route::put('/updateComment/{id}', [CommentApiController::class, 'updateComment']);

//update comment
//alternate version, does not require all the fields and only updates those which are present
Route::put('/partiallyUpdateComment/{id}', [CommentApiController::class, 'updateCommentPartial']);

//delete comment
Route::delete('/deleteComment/{id}', [CommentApiController::class, 'deleteComment']);
