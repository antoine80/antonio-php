<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';
    public $timestamps = true;
    protected $primaryKey = 'name';
    protected $fillable = ['name'];

    function sensors(){
    	return $this->hasMany('App\Sensor', 'device', 'name');
    }
}
