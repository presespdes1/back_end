<?php
namespace App\src\Response\Infrastructure\Dependencies;

use App\src\Response\Domain\Contracts\ICustomResponse;
use App\src\Response\Infrastructure\Adapters\LaravelCustomResponse;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
 /**
     * Register any customer application services
     * @return void
     */
    public function register()
    {
         $this->app->bind(ICustomResponse::class, LaravelCustomResponse::class);
    }

    /**
     * Bootstrap any application services here
     * @return void
     */
    public function boot():void
    {
        
    }
}