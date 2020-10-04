<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Comment;

class Post extends Model
{
    //

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setPostImageAttribute($value){
        $this->attributes['post_image'] = asset($value);
    }

    public function getPostImageAttribute($value){

        // dd($value);

        if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE){
            return $value;
        }
        
        return asset($value);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


}
