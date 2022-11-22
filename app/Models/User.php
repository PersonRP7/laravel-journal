<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        //Every new user is automatically created as admin to make it simpler to use the application.
        //Real usecase would be opposite.
        'role' => 'admin',
    ];

    public function toAdmin()
    {
        $this->role = "admin";
        $this->save();
    }

    public static function findOrFalse($user_id)
    {
        //Used in the allowDelete method
        try { 
             User::findOrFail($user_id)->role == 'admin';
             return true;
        } catch (\Throwable $e) {
              return false;
        }
    }

    public function allowDelete($user_id)
    //Allow admin to delete other users
    //Used in the UserController/destroy
    {
        if ($this->id == $user_id)
        {
            //If the id of the current user instance is equal to the id of the currently logged in
            //user, the method returns true to allow the deletion of the current user profile.
            return true;
        }
        elseif (User::findOrFalse($user_id)) {
            //If the currently logged in user is an admin, the method returns true to allow
            //the deletion of own as well as other profiles.
            return true;
        }
        else
        {
  
            //If none of the cases are true, the method returns false and disallows
            //the user profile deletion.
            return false;
        }
    }

}
