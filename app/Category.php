<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $fillable = ['name'];


    public function getNameAttribute($name){
        return ucfirst($name);
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function showSubCategories($id){
        $categories = [];
        if($this->hasSubCategory($id)){
            $categories = $this::where('parent_id', $id)->pluck('name', 'id');
        }
        return $categories;
    }

    public function hasSubCategory($id){
        $subCategories = $this::where('parent_id', $id)->pluck('name', 'id')->count();
        if($subCategories > 0)
            return true;
        return false;
    }

    public function showMegaCategory(){
        $megaCategories = $this::where('parent_id', null)->get();
        return $megaCategories;
    }
}
