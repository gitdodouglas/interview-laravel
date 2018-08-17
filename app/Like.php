<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'user_nickname',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
