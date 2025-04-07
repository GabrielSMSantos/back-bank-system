<?php

use App\Modules\BankAccount\Infrastructure\Providers\BankAccountProvider;
use App\Modules\Customer\Infrastructure\Providers\CustomerProvider;

return [
    App\Providers\AppServiceProvider::class,
    CustomerProvider::class,
    BankAccountProvider::class
];
