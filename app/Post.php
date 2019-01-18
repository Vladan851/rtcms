<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    //
    //
    use Sluggable;
    use SluggableScopeHelpers;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            
            'slug' => [
                'source' => 'title',   
            ]
        ];
    }
    
    protected $fillable = [
        'url', 
        'user_id', 
        'photo_id', 
        'category_id', 
        'author', 
        'source', 
        'title', 
        'content',
        'published', 
        'featured', 
        'count',
        'slug'
    ];
    
    public function user() {
        
        return $this->belongsTo('App\User');
        
    }
    
    public function photo() {
        
        return $this->belongsTo('App\Photo');
        
    }
    
     public function category() {
        
        return $this->belongsTo('App\Category');
        
    }
    
    public function comments() {
        
        return $this->hasMany('App\Comment');
        
    }
    
}



