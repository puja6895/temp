<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Setting;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Default Length
        Schema::defaultStringLength(191);

        // Setting
        if (Schema::hasTable('settings')) {
            
            // Settings
            $all_settings = Setting::all();
            foreach ($all_settings as $setting) {
                # Share To All View
                View::share($setting->name, $setting->val);

            }
        }
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
