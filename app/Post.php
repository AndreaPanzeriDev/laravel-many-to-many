<?php

namespace App;

use App\Tag;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'body',
        'category_id',
        'image',
    ];

    public function category(){
        //il post ha solo una category associata
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
