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
    return view('welcome');
});

Route::get('store/{name}/{type}/{value}', function($name, $type, $value) {   
    
   if($device = Device::where('name', $name)->first() ) {
   	  $device->touch();
   	  $name = $device->name . ' actualizado el ' . $device->updated_at;
   }

   else {
     $device = New App\Device;
     $device->name = $name;
     $device->save();
   }

    // return view('store', compact('name', 'type', 'value'));
    return $device;
});
