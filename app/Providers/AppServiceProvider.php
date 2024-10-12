<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
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
        // disabled lazy loading
        // Model::preventLazyLoading();  

        // Buat gerbang untuk mendefinisikan apakah dia admin apa bukan
        // Gate lebih fleksibel dibandingkan dengan middleware
        // Bisa digunakan di manapun dengan method @can @endcan
        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });     
    }
}
