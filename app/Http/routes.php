<?php

use App\Device;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('store/{name}', function($name) {

	$input =Request::only('temperatura', 'luz', 'humedad1', 'humedad2', 'humedad3', 'humedad4');

   	if(!$device = Device::find($name) ) {
   		$device = App\Device::create(['name' => $name]);
     	$device->save();
     	$device->name = $name;
   		$device = Device::find($name);
   	}

   	foreach($input as $type => $value){
   		if($value != null) {
   			$sensor = new App\Sensor(['type' => $type, 'value' => $value]);
			$device->sensors()->save($sensor);
   		}
   	}

    return Device::with('sensors')->find($name);
});
