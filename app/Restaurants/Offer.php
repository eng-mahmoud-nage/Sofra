<?php

namespace App\Restaurants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('image', 'name', 'description', 'from', 'restaurant_id', 'to');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants\Restaurant', 'restaurant_id');
    }

}
