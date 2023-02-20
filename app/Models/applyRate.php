<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applyRate extends Model
{
    use HasFactory;
    public function apply()
    {
        return $this->belongsTo(apply::class);
    }
}
