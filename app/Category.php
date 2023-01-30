<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{



    public function post(){
        //la category può avere molti post associati
        return $this->hasMany('App/Post');
    }
}
