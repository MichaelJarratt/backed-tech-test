<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; //like with the blog controller, this could ask the blog controller to check if a blog exists, but it creates a dependency on the other controller in order to have this one work
use App\Models\Comment;

class CommentApiController extends Controller
{
    //commit new comment to DB
    public function commitComment(Request $request)
    {

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
    }

    //update comment
    public function updateComment($id, Request $request) {
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
    }

    //update comment
    //alternate version, does not require all the fields and only updates those which are present
    public function updateCommentPartial($id, Request $request) {
        //if no fields are being updated then return an error
        if(!$request->hasAny(['title', 'name', 'email', 'comment']))
        {
            return ['error' => 'missing input(s)'];
        }

        $comment = Comment::find($id);
        if($comment == null)
        {
            return ['error' => 'invalid comment_id'];
        }

        //update this instance of the model in memory and then save changes to database
        if($request->has('title'))
        {
            $comment->title = $request->input('title');
        }
        if($request->has('name'))
        {
            $comment->name = $request->input('name');
        }
        if($request->has('email'))
        {
            $comment->email = $request->input('email');
        }
        if($request->has('comment'))
        {
            $comment->comment = $request->input('comment');
        }
        $status = $comment->save(); //replace the database instance with this instance

        return ['status' => $status];
    }

    //delete comment
    public function deleteComment($id) {

        $comment = Comment::find($id);

        if($comment == null)
        {
            return ['error' => 'invalid comment_id'];
        }

        $status = $comment->delete();

        return ['status' => $status];
    }
}
