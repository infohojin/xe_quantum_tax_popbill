<?php

namespace XEHub\XePlugin\CustomQuantum\Tax;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class TaxServiceProvider extends ServiceProvider
{
    private $package = "tax";
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {

    }

}
