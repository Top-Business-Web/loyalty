<?php

namespace App\Providers;

use View;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        View::share('setting', Setting::first());
        View::share('admins', Admin::all());
    }
}
