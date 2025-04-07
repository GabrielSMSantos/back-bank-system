<?php

namespace App\Modules\Customer\Infrastructure\Providers;

use App\Modules\Customer\Domain\Repositories\ICustomerRepository;
use App\Modules\Customer\Infrastructure\Repositories\Eloquent\CustomerRepository;
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
                $this->loadRoutesFrom(__DIR__ .'/../../Presentation/Routes/api.php');
            });
    }
}
