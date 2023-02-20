<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fortfolio extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function fortDetile()
    {
        return $this->hasMany(fortDetiles::class);
    }
}
