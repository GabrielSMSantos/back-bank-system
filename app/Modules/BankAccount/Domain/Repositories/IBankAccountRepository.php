<?php

namespace App\Modules\BankAccount\Domain\Repositories;

use App\Modules\BankAccount\Domain\Entities\BankAccount;
use App\ValueObjects\Uuid;

interface IBankAccountRepository
{
    public function create(BankAccount $entity): int;
    public function edit(BankAccount $entity): bool;
    public function findByAccountNumber(int $accountNumber): ?BankAccount;
    public function findByCustomerUuid(Uuid $customerUuid): ?BankAccount;
}
