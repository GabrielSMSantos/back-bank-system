<?php

namespace App\Infrastructure\BankAccount\Providers;

use App\Domain\BankAccount\Repositories\IBankAccountRepository;
use App\Infrastructure\BankAccount\Repositories\BankAccountRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BankAccountProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes();
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->app->bind(IBankAccountRepository::class, BankAccountRepository::class);
    }

    private function routes(): void
    {
        Route::prefix('bankAccounts')
            ->name('bankAccount.')
            ->group(function() {
                $this->loadRoutesFrom(__DIR__ .'/../Presentation/Routes/api.php');
            });
    }
}
