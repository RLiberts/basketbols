<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Game;
use App\Models\Team;
use App\Policies\GamePolicy;
use App\Policies\TeamPolicy;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Game::class, GamePolicy::class);
        Gate::policy(Team::class, TeamPolicy::class);
    }
}
