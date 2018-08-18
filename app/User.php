<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'nickname', 'name', 'email', 'password',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'password',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getRememberTokenName()
    {
        return null;
    }
}
