<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\ICartRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\Artisan\IArtisanRepository;
use App\Repositories\Artisan\ArtisanRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\IProductRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\ICommentRepository;
use App\Repositories\Rating\IRatingRepository;
use App\Repositories\Rating\RatingRepository;
use App\Services\DateService\DateService;
use App\Services\DateService\IDateService;

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
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);
        $this->app->bind(IRatingRepository::class, RatingRepository::class);
        $this->app->bind(IDateService::class, DateService::class);
    }
}
