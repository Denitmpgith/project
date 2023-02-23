<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    use HasFactory;
    public function Level()
    {
        $level_array = ([
            ['level' => 'Stone', 'min' => 100, 'max' => 200],
            ['level' => 'Bronze', 'min' => 201, 'max' => 300],
            ['level' => 'Silver', 'min' => 301, 'max' => 400],
            ['level' => 'Gold', 'min' => 401, 'max' => 500],
            ['level' => 'Platinum', 'min' => 501, 'max' => 600],
            ['level' => 'Diamond', 'min' => 601, 'max' => 700],
        ]);
        return $level_array;
    }
}
