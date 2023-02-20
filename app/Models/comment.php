<?php

namespace App\Models;

use App\Models\Post;
use App\Models\replyComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function replyComments()
    {
        return $this->hasMany(replyComment::class);
    }
        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
