<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function create(Request $request)
    {
        $like = new Like;
        $like->post_id = $request->json('post_id');
        $like->user_id = $request->json('user_id');
        $like->user_nickname = $request->json('user_nickname');
        $like->save();
        return $like;
    }

    public function read($id)
    {
        return $this->getLike($id);
    }

    public function delete($id)
    {
        $like = $this->getLike($id);
        $like->delete();
        return $like->id;
    }

    public function query($key, $value)
    {
        return Like::where($key, $value)->first();
    }

    private function getLike($id)
    {
        return Like::find($id);
    }
}
