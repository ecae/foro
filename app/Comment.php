<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'post_id','answer'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function markAsAnswer()
    {
        $this->pending = false;
        $this->post->answer_id = $this->id;

        $this->post->save();
    }

    public function getAnswerAttribute()
    {
        return $this->id == $this->post->answer_id;
    }
}
