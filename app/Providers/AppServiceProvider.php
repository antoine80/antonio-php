<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Device;
use App\Sensor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Grace period for arduinos to send info
        $grace = 36000;
        // Data for the view
        $data = [
            'live' => [],
            'missing' => []
        ];
        
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

        view()->share('live', $data['live']);
        view()->share('missing', $data['missing']);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
