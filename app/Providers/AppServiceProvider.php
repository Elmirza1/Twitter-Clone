<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        // app()->setLocale('es');
        App::setLocale('es');
        \Debugbar::enable();

        Cache::forget('topUsers'); // clears specific key
        // cache()->forget('topUsers'); // 

        $topUsers = Cache::remember('topUsers', 60*2, function(){
               return User::withCount('ideas')
                    ->orderBy('ideas_count', 'DESC')
                    ->limit(5)->get();
            });
        Cache::flush(); // clears entire cache

        View::share('topUsers', $topUsers);
    }
}
