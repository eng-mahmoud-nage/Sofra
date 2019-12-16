<?php

namespace App\Restaurants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{

    protected $table = 'restaurants';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'phone',
                                'district_id', 'pin_code', 'api_token',
                                'password', 'image', 'minimum_charge',
                                'delivery_charge', 'whats_app_number',
                                'delivery_time', 'available', 'active');

    protected $hidden = array('api_token', 'password', 'active');

    public function districts()
    {
        return $this->belongsTo('App\General\District', 'district_id');
    }

    public function products()
    {
        return $this->hasMany('App\General\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\General\Order');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Restaurants\Category');
    }

    public function offers()
    {
        return $this->hasMany('App\Restaurants\Offer');
    }

    public function transactions()
    {
        return $this->hasMany('App\General\Transaction');
    }

    public function reviews()
    {
        return $this->hasMany('App\General\Review');
    }

    public function notifications()
    {
        return $this->morphMany('App\General\Notification', 'notifable');
    }

    public function contacts()
    {
        return $this->morphMany('App\General\Contact', 'contactable');
    }

    public function token()
    {
        return $this->morphOne('App\General\Token', 'accountable');
    }

}
