<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\{Wishlist,Cart};
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
        // Pass global variables to all views
        view()->composer('*', function ($view) {
            // Check if the user is authenticated
            if (Auth::check()) {
                // Get the authenticated user ID
                $userId = Auth::id();

                // Get the wishlist and cart counts
                $userWishlistCount = Wishlist::where('user_id', $userId)->count();
                $cartCount = Cart::where('user_id', $userId)->count();

                // Share the counts globally with all views
                $view->with('UserWishlistCount', $userWishlistCount);
                $view->with('CartCount', $cartCount);
            } else {
                // If the user is not authenticated, pass zero counts
                $view->with('UserWishlistCount', 0);
                $view->with('CartCount', 0);
            }
        });
    }
}
