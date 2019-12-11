<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resturantable extends Model 
{

    protected $table = 'resturantables';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('resturant_id', 'resturantable_id', 'resturantable_type', 'is_read');

}