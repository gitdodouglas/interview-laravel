<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $comment = new Like;
        $comment->post_id = $request->json('post_id');
        $comment->user_id = $request->json('user_id');
        $comment->user_nickname = $request->json('user_nickname');
        $comment->comment = $request->json('comment');
        $comment->save();
        return $comment;
    }

    public function read($id)
    {
        return $this->getComment($id);
    }

    public function delete($id)
    {
        $comment = $this->getComment($id);
        $comment->delete();
        return $comment->id;
    }

    public function query($key, $value)
    {
        return Comment::where($key, $value)->first();
    }

    private function getComment($id)
    {
        return Comment::find($id);
    }
}
