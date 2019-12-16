<?php

namespace App\Restaurants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');

    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurants\Restaurant');
    }

}
