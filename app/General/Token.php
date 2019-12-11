<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';
    protected $fillable = ['client_id', 'token', 'type'];
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo('App\Client\Client', 'client_id');
    }
}
