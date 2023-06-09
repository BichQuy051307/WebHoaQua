<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

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
        if (!App::runningInConsole()) {
            View::share('list_categories', Category::orderBy('created_at', 'desc')->get());
            View::share('list_products', Product::where('status', 1)->orderBy('created_at', 'desc')->limit(10)->get());
            View::share('price_sale_min_product', Product::where('status', 1)->min('price_sale'));
            View::share('price_sale_max_product', Product::where('status', 1)->max('price_sale'));
        }
    }
}
