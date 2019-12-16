<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'phone', 'password', 'api_token', 'pin_code', 'image', 'district_id');
    protected $hidden = array('api_token', 'password', 'pin_code', 'active');

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

    public function orders()
    {
        return $this->hasMany('App\General\Order');
    }

    public function token()
    {
        return $this->morphOne('App\General\Token', 'accountable');
    }

}
