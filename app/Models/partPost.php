<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partPost extends Model
{
    use HasFactory;
    public function post()
    {
        return $this->belongsTo(post::class);
    }
}
