<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\SiteSetting;
use Illuminate\Support\Facades\View;
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
        View::composer('Frontend.*', function ($view) {
      		 $view->with('setting',SiteSetting::first());
});
    }
}
