<?php

namespace SystemData\Providers;

use Illuminate\Support\ServiceProvider;

class SystemDataServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(base_path('modules/SystemData/views'), 'SystemData');
    }
}
