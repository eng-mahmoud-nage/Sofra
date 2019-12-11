<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model 
{

    protected $table = 'districts';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'city_id');

    public function city()
    {
        return $this->belongsTo('App\General\City', 'city_id');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Resturant\Resturant');
    }

}