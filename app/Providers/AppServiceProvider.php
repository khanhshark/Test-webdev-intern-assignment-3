<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\StudentScoreService;
use App\Interfaces\StudentScoreServiceInterface;
use App\Interfaces\ExporterInterface;
use App\Services\ExcelExporter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(StudentScoreServiceInterface::class, StudentScoreService::class);
        $this->app->bind(ExporterInterface::class, ExcelExporter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
