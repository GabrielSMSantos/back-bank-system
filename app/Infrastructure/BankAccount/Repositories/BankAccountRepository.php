<?php

namespace App\Infrastructure\BankAccount\Repositories;

use App\Domain\BankAccount\Entities\BankAccount;
use App\Domain\BankAccount\Repositories\IBankAccountRepository;
use App\Infrastructure\BankAccount\Models\BankAccount as Model;
use App\ValueObjects\Uuid;

class BankAccountRepository implements IBankAccountRepository
{
    public function create(BankAccount $entity): int
    {
        $bankAccount = Model::create($entity->toArray());
        return $bankAccount->id;
    }

    public function edit(BankAccount $entity): bool
    {
        return Model::where('uuid', $entity->getUuid())->update($entity->toArray());
    }

    public function findByAccountNumber(int $accountNumber): ?BankAccount
    {
        $bankAccount = Model::where('account_number', $accountNumber)->first();
        if (!$bankAccount) {
            return null;
        }

        return BankAccount::withCustomerUuidAccountNumberAndBalance(
        new Uuid($bankAccount->uuid),
        new Uuid($bankAccount->customer_uuid),
        $bankAccount->account_number,
        $bankAccount->balance
        );
    }

    public function findByCustomerUuid(Uuid $customerUuid): ?BankAccount
    {
        $bankAccount = Model::where('customer_uuid', $customerUuid)->first();
        if (!$bankAccount) {
            return null;
        }

        return BankAccount::withCustomerUuidAccountNumberAndBalance(
        new Uuid($bankAccount->uuid),
        new Uuid($bankAccount->customer_uuid),
        $bankAccount->account_number,
        $bankAccount->balance
        );
    }
}
