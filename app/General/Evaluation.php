<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model 
{

    protected $table = 'evaluations';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('status', 'comment');

    public function restaurant()
    {
        return $this->morphMany('App\Restaurant\Restaurant', 'restaurantable');
    }

    public function client()
    {
        return $this->morphMany('App\Client\Client', 'clientable');
    }

}