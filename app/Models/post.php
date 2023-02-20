<?php

namespace App\Models;

use App\Models\User;
use App\Models\PostFile;
use App\Models\partPost;
use App\Models\ListCategory;
use App\Models\Apply;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function postFile()
    {
        return $this->hasMany(postFile::class);
    }
    public function partPost()
    {
        return $this->hasMany(partPost::class);
    }
    public function listCategory()
    {
        return $this->hasMany(listCategory::class);
    }
    public function applies()
    {
        return $this->hasMany(apply::class);
    }
    public function comments()
    {
        return $this->hasMany(comment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
