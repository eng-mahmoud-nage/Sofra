<?php

namespace App\Resturant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryResturant extends Model 
{

    protected $table = 'category_resturant';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('resturant_id', 'category_id');

}