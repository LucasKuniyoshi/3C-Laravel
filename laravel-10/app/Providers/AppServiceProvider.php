<?php

namespace App\Providers;

use App\Models\Support;
use App\Observers\SupportObserver;
use App\Repositories\{SupportEloquentORM};
use App\Repositories\Contracts\{ReplyRepositoryInterface, SupportRepositoryInterface};
use App\Repositories\Eloquent\ReplySupportRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //bind =>onde tiver uma classe abstrata(interface=>Support), eu vou injetar uma classe concreta
        $this->app->bind(
            SupportRepositoryInterface::class,
            SupportEloquentORM::class
        );

        $this->app->bind(
            ReplyRepositoryInterface::class,
            ReplySupportRepository::class
        );;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Support::observe(SupportObserver::class);
    }
}
