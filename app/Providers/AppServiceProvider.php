<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
         Schema::defaultStringLength(191);
          // Ajoute ceci pour forcer le format de ligne
            // DB::statement('SET SESSION innodb_strict_mode=ON');
            // DB::statement('SET SESSION sql_require_primary_key=0');
    }
}
