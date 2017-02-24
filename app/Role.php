<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable=['name'];

    public function users(){
        return $this->hasMany('App\User');
    }

    /**
     * @return array
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
