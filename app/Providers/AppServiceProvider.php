<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Para usar el paginator utilizamos esta libreria
use Illuminate\Pagination\Paginator;


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
        // Para usar el paginator agregamos esta instancia
       Paginator::useBootstrap();
    }
}
