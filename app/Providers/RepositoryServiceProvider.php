<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\ICartRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\Artisan\IArtisanRepository;
use App\Repositories\Artisan\ArtisanRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ICartRepository::class, CartRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IArtisanRepository::class, ArtisanRepository::class);
    }
}
