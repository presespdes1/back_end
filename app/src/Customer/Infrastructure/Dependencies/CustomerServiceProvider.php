<?php
namespace App\src\Customer\Infrastructure\Dependencies;

use App\src\Customer\Domain\Contracts\IAuthentication;
use App\src\Customer\Infrastructure\Adapters\LaravelAuthenticationAdapter;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register any customer application services
     * @return void
     */
    public function register()
    {
         $this->app->bind(IAuthentication::class, LaravelAuthenticationAdapter::class);
    }

    /**
     * Bootstrap any application services here
     * @return void
     */
    public function boot():void
    {
        
    }
}