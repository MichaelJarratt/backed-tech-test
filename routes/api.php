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

Route::put('/blogsb', function() {
    return null;
});

Route::delete('/blogsc', function() {
    return null;
});
