<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'user_nickname', 'comment',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(Post::class);
    }
}
