<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apply extends Model
{
    use HasFactory;
    public function post()
    {
        return $this->belongsTo(post::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function applyFile()
    {
        return $this->hasMany(applyFile::class);
    }
    public function applyRate()
    {
        return $this->belongsTo(applyRate::class);
    }
}
