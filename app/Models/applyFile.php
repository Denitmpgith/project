<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applyFile extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    public function apply()
    {
        return $this->belongsTo(apply::class);
    }
}
