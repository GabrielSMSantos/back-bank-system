<?php

namespace App\Infrastructure\Customer\Providers;

use App\Domain\Customer\Repositories\ICustomerRepository;
use App\Infrastructure\Customer\Repositories\Eloquent\CustomerRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CustomerProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes();
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
    }

    private function routes(): void
    {
        Route::prefix('customers')
            ->name('customer.')
            ->group(function() {
                $this->loadRoutesFrom(__DIR__ .'/../Presentation/Routes/api.php');
            });
    }
}
