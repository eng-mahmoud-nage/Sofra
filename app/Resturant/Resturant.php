<?php

namespace App\Resturant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Resturant extends Authenticatable 
{

    protected $table = 'resturants';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = array('name', 'email', 'phone', 
                                    'district_id', 'password', 
                                    'category_id', 'image', 'minimum_charge', 
                                    'delivery_charge', 'whats_app_number', 'status', 
                                    'commission', 'pin_code');

    protected $hidden = array('api_token', 'password', 
    'pin_code', 'active', 'commission');

    public function districts()
    {
        return $this->belongsTo('App\General\District', 'district_id');
    }

    public function products()
    {
        return $this->morphTo();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Resturant\Category');
    }

    public function offers()
    {
        return $this->morphTo();
    }

    public function transactions()
    {
        return $this->morphTo();
    }

    public function evaluations()
    {
        return $this->morphTo();
    }

    public function notifications()
    {
        return $this->morphTo(); //is_read
    }

}