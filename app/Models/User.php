<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

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

    // protected $attributes = [
    //     'role' => 'regular',
    // ];
    protected $attributes = [
        'role' => 'admin',
    ];

    public function toAdmin()
    {
        $this->role = "admin";
        $this->save();
    }

    public function allowDelete($user_id)
    #Allow admin to delete other users
    {
        if ($this->id == $user_id)
        {
            return true;
        }
        elseif (User::find($user_id)->role == 'admin') {
            return true;
        }
        else
        {
            return false;
        }
    }

}
