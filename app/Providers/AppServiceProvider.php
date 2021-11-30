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
            $cart = Session::get('cart') > 0 ? Session::get('cart') : 0;
            $total = Session::get('total') > 0 ? Session::get('total') : 0;

            $view->with('username', Session::get('username'));
            $view->with('cartCount', count($cart));
            $view->with('cartData', $cart);
            $view->with('total', $total);
        });
    }
}
