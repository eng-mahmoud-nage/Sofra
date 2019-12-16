<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'notes', 'price', 'discount', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants\Restaurant', 'restaurant_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\General\Order', 'order_id');
    }

}
