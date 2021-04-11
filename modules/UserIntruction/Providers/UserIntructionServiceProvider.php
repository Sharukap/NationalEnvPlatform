<?php

namespace UserIntruction\Providers;

use Illuminate\Support\ServiceProvider;

class UserIntructionServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('modules/UserIntruction/views'), 'UserIntruction');
    }
}
