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

//get all the fields from all the blogs
Route::get('/blogs', function() {
    $data = Blog::all();
    return $data;
});

//get all the fields from a single blog by ID (in QueryString)
Route::get('/blog', function(Request $request) {

    //extract data from queryString
    $id = $request->input('id');

    //find the blog
    $blog = Blog::where('id',$id) -> get();

    //find comments for blog
    $comments = Comment::where('blog_id',$id) -> get();

    //compose as return JSON
    $data = [
        'blog' => $blog,
        'comments' => $comments
    ];

    return $data;
});

//alternate implementation of the API above. Did this after the update comment function and realised I could pass in the ID this way
Route::get('/blog/{id}', function($id, Request $request){
    //find the blog
    $blog = Blog::where('id',$id) -> get();

    //find comments for blog
    $comments = Comment::where('blog_id',$id) -> get();

    //compose as return JSON
    $data = [
        'blog' => $blog,
        'comments' => $comments
    ];

    return $data;
});

//commit new comment to DB
Route::post('/comment', function(Request $request) {

    //check all values are present
    if(!$request->has(['title', 'name', 'email', 'comment', 'blog_id']))
    {
        return ['error' => 'missing input(s)'];
    }

    //check if the blog is valid
    if(!Blog::where('id', $request->input('blog_id'))->exists())
    {
        return ['error' => 'invalid blog_id'];
    }

    return Comment::create([
        'title' => $request->input('title'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'comment' => $request->input('comment'),
        'blog_id' => $request->input('blog_id'),
    ]);

});

//update comment
Route::put('/updateComment/{id}', function($id, Request $request) {
    //I'm aware that this code is copied from the above route, however I don't know where the appropriate place to put this as reusable code would be within this framework
    if(!$request->has(['title', 'name', 'email', 'comment']))
    {
        return ['error' => 'missing input(s)'];
    }

    $comment = Comment::find($id);
    if($comment == null)
    {
        return ['error' => 'invalid comment_id'];
    }

    $status =  $comment->update([
        'title' => $request->input('title'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'comment' => $request->input('comment'),
    ]);

    return ['status' => $status];
});

//delete comment
Route::delete('/deleteComment/{id}', function($id) {

    $comment = Comment::find($id);

    if($comment == null)
    {
        return ['error' => 'invalid comment_id'];
    }

    $status = $comment->delete();

    return ['status' => $status];
});
