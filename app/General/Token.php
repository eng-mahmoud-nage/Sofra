<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{

    protected $table = 'tokens';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = array('token', 'type');


    public function restaurants()
    {
        return $this->morphTo();
    }

    public function clients()
    {
        return $this->morphTo();
    }

}
