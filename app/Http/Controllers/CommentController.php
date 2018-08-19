<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($post_id, Request $request, User $user)
    {
        $comment = new Comment;
        $comment->post_id = $post_id;
        $comment->user_id = $user->id;
        $comment->user_nickname = $user->nickname;
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
