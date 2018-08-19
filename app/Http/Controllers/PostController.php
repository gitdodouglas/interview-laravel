<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showAll()
    {
        return Post::all();
    }

    public function create(Request $request, User $user)
    {
        $post = new Post;
        $post->user_id = $user->id;
        $post->user_nickname = $user->nickname;
        $post->title = $request->json('title');
        $post->text = $request->json('text');
        $post->view = 0;
        $post->save();
        return $post;
    }

    public function read($id)
    {
        return $this->getPost($id);
    }

    public function delete($id)
    {
        $post = $this->getPost($id);
        $post->delete();
        return $post->id;
    }

    public function query($key, $value)
    {
        return Post::where($key, $value)->first();
    }

    private function getPost($id)
    {
        return Post::find($id);
    }

    public function comments($id)
    {
        return Post::find($id)->comments;
    }
}
