<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        
        'post_id',
        'author',
        'email',
        'is_active',
        'body'
        
    ];


    public function replies(){
        
        return $this->hasMany('App\CommentReplay');
        
    }
    
    public function post(){
        return $this->belongsTo('App\Post');
    }
    
}
