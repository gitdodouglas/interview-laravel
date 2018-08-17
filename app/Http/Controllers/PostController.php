<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $post = new Post;
        $post->user_id = $request->json('user_id');
        $post->user_nickname = $request->json('user_nickname');
        $post->title = $request->json('title');
        $post->text = $request->json('text');
        $post->view = $request->json('view');
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
}
