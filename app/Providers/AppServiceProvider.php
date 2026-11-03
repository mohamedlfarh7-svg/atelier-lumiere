<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
     // 1. تأكد بلي زايد هاد الفوق

public function boot(): void
{
    // 2. زيد هاد السطر هنا باش يفرض https على جميع الروابط
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
}
}
