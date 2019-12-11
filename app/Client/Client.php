<?php

namespace App\Client;

use App\General\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'phone', 'password', 'image', 'district_id', 'pin_code');
    protected $hidden = array('api_token', 'password', 'pin_code', 'active');

    public function evaluations()
    {
        return $this->morphTo();
    }

    public function notifications()
    {
        return $this->morphTo();
    }

    public function orders()
    {
        return $this->morphMany('App\General\Order', 'clientable');
    }

}