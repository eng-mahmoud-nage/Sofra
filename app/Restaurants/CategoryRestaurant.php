<?php

namespace App\Restaurants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryRestaurant extends Model
{

    protected $table = 'category_restaurant';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('restaurant_id', 'category_id');

}
