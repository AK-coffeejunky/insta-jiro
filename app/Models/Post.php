<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;


class Post extends Model
{

    use HasFactory, Notifiable, SoftDeletes;
    //To get the owner of the post
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    #To get the categories under a post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    #To get all the comments of a post
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    #To get the likes of a post
    public function likes(){
        return $this->hasMany(Like::class);
    }

    #Return TRUE if the AUTH user already liked the post
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
