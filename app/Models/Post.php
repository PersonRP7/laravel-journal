<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'name',
        // 'path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Another argument for post_id?
    public function allowDelete($user_id)
    {
        if ($this->user->id == $user_id)
        {
            echo "This post can be deleted.";
        }else
        {
            echo "This post doesn't belong to this user";
        }
    }
}
