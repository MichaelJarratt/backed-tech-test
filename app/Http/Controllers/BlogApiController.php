<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment; //perhaps instead of using the model directly, it can request the data from CommentApiController? it means this wouldn't need to use the Comment model, but it would then create a dependancy


class BlogApiController extends Controller
{
    //get all the fields from all the blogs
    public function getAll()
    {
        $data = Blog::all();
        return $data;
    }

    //get all the fields from a single blog by ID (in QueryString)
    public function getByIDQueryString(Request $request)
    {

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
    }


    //alternate implementation of the API above. Did this after the update comment function and realised I could pass in the ID this way
    public function getByID($id, Request $request)
    {
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
    }
}
