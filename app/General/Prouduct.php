<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prouduct extends Model 
{

    protected $table = 'products';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'notes', 'price', 'discount', 'processing_time');

    public function restaurant()
    {
        return $this->morphMany('App\Resturant\Resturant', 'resturantable');
    }

    public function orders()
    {
        return $this->belongsToMany('App\General\Order', 'order_id');
    }

}