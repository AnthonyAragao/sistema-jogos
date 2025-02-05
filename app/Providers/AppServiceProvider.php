<?php

namespace App\Providers;

use App\Http\Adapters\HttpClientAdapter;
use App\Http\Adapters\HttpClientInterface;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HttpClientInterface::class, HttpClientAdapter::class);
    }

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
