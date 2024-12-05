<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        View::composer('layout.design', function ($view) {
            $name = auth('student')->check() ? auth('student')->user()->name : 'Login';
            $view->with('name', $name);
        });
        View::composer('*', function ($view) {

            $userId = auth('student')->id();
            if ($userId) {
                $cartData = DB::table('cart')->where('user_id', $userId)->get();
                $wishlistData = DB::table('user_wishlist')->where('user_id', $userId)->get();
            } else {
                $cartData = collect(); // Empty collection if not logged in
                $wishlistData = collect(); // Empty collection if not logged in
            }
            $view->with('cartData', $cartData)->with('wishlistData', $wishlistData);
        });
    }
}
