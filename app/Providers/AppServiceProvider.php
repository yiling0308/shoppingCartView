<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
use Storage;

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
        view()->composer('*', function ($view)
        {
            $cartData = Session::get('cart') > 0 ? Session::get('cart') : 0;
            $cartCount = Session::get('cart') > 0 ? count(Session::get('cart')) : 0;
            $total = Session::get('total') > 0 ? Session::get('total') : 0;

            $view->with('user', Session::get('user'));
            $view->with('cartCount', $cartCount);
            $view->with('cartData', $cartData);
            $view->with('total', $total);
        });
    }
}
