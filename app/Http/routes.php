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

	// Grace period for arduinos to send info
	$grace = 36000;
	// Data for the view
	$data = [
		'live' => [],
		'missing' => []
	];
	// Puntos para las gráficas
	$points = [];

	$devices = Device::all();


	foreach ($devices as $key => $device) {
		// device->updated_at is Carbon object, need to change to timestamp
		if ($device->updated_at->timestamp <= (time() - $grace)  ){
			$data['missing'][] = $device;
		}
		else {
			$data['live'][] = $device;
		}
	}

	// dd($data);

	// De los live sacar los puntos para las gráficas
	foreach ($data['live'] as $device) {
		foreach ($device->sensors as $sensor){
			// $points['arduino1']['2015-07-19 14:30']['humedad1'] = 35
			//$points[$device->name]['by_date'][$sensor->created_at->toDateTimeString()][$sensor->type] = $sensor->value;
			// $points['arduino1']['humedad1'][] = ['2015-07-19 14:30', 35]
			$points[$device->name][$sensor->type][] = [$sensor->created_at->timestamp, $sensor->value];
		}
	}
	// pasamos los datos a la vista para allí pasarlo al JS
	$data['toJavascript']['points'] = $points;

    return view('dashboard')->with($data);
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


Route::get('devices/{name}', function($name) {

   	if(!$device = Device::find($name) ) {
   		return redirect('/');
   	}


	foreach ($device->sensors as $sensor){
		$points[$device->name][$sensor->type][] = [$sensor->created_at->timestamp, $sensor->value];
	}

	$data['device'] = $device;
	$data['toJavascript']['points'] = $points;

   	return view('device')->with($data);
});