<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = new User;
        $user->name = $request->json('name');
        $user->nickname = $request->json('nickname');
        $user->email = $request->json('email');
        $user->password = bcrypt($request->json('password'));
        $user->save();
        return $user;
    }

    public function read($id)
    {
        return $this->getUser($id);
    }

    public function delete($id)
    {
        $user = $this->getUser($id);
        $user->delete();
        return $user->id;
    }

    public function query($key, $value)
    {
        return User::where($key, $value)->first();
    }

    private function getUser($id)
    {
        return User::find($id);
    }
}
