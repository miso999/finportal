<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'email',
        'body',
        'is_active'
    ];

    public function replies()
    {
        return $this->hasMany('App\CommentReply');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postSlug()
    {
        return Post::findOrFail($this->post_id)->slug;
    }
}
