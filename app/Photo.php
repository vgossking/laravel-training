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
    /*
     *
     *
     */
    public function generateNewNameIfExist($fileName){
        $count = 0;
        while($this->checkPathNameExist($fileName)){
            $count++;
            $fileName = $count.'-'.$fileName;
        }
        return $fileName;
    }


    public function checkPathNameExist($fileName){
        $photos = DB::table('photos')->where('path',$fileName)->count();
        if($photos > 0)
            return true;
        return false;
    }

    
    public function unlinkFileIfExist(){
        if(file_exists(public_path().$this->path)){
            unlink(public_path().$this->path);
        }
    }
}
