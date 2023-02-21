<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\user_detiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function apply()
    {
        return $this->hasMany(apply::class);
    }
    public function comment()
    {
        return $this->hasMany(comment::class);
    }
    public function replyComment()
    {
        return $this->hasMany(replyComment::class);
    }
    public function fortfolio()
    {
        return $this->belongsTo(fortfolio::class);
    }
    public function user_detiles()
    {
        return $this->hasOne(user_detiles::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'username',
    //     'password',
    // ];
    protected $guarded =['id', 'create_at', 'update_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
