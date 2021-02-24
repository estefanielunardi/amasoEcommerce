<?php

namespace App\Providers;



use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        View::composer(['products.create','products.create'], 'App\Http\ViewsComposer\ProductAllergensComposer');
        Schema::defaultStringLength(191);
    }
}
