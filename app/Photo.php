<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function checkPathNameExist($fileName){
        $photos = DB::table('photos')->where('path',$fileName)->count();
        if($photos > 0)
            return true;
        return false;
    }
}
