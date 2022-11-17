<?php

namespace App\Providers;

use App\Models\Complaint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();
        $complaintstoday = Complaint::whereDay('created_at', now()->day)->count();
        view()->share('complaintstoday', $complaintstoday);
    }
}
