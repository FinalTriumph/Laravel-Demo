<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/*If error about string length - part 1/2
use Illuminate\Support\Facades\Schema;
*/

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*If error about string length - part 2/2
        Schema::defaultStringLength(191);
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
