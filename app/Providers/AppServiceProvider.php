<?php

namespace App\Providers;



use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
        View::composer(['layouts.navigation','components.button-cart'], 'App\Http\ViewsComposer\NavComposer');
        View::composer(['products.create','products.edit'], 'App\Http\ViewsComposer\ProductAllergensComposer');
        Schema::defaultStringLength(191);
        Carbon::setLocale(config('app.locale'));
    }
}
