<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public $imageLink = '/images/';

    protected $fillable=['path'];

    public function user(){
        return $this->hasOne('App\User');
    }

    public function getPathAttribute($path){
        return $this->imageLink.$path;
    }
}
