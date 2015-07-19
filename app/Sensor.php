<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table = 'sensors';
    public $timestamps = true;
    protected $fillable = ['device', 'type', 'value'];
    protected $touches = ['device'];

    function device(){
    	return $this->belongsTo('App\Device', 'device');
    }

}
