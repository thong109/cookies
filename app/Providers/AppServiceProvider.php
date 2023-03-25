<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Visitor;
use Illuminate\Support\ServiceProvider;
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
        // $wishlist = User::where('id', 1)->with('user_info')->first();

        view()->composer('*', function ($view) {
            //total
            $product = Product::all()->count();
            $app_order = Order::all()->count();
            $app_customer = Customer::all()->count();
            $views = Product::orderByRaw('CONVERT(views, SIGNED) desc')->paginate(10);
            $view->with(compact('app_order', 'app_customer','product','views'));
        });
        Paginator::defaultView('pagination');
    }
}
