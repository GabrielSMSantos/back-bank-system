<?php

namespace App\Domain\BankAccount\Entities;

use App\ValueObjects\Uuid;

class BankAccount
{
    private function __construct(
        private Uuid $uuid,
        private Uuid $customerUuid,
        private string $accountNumber,
        private int $balance
    ) { }

    public static function withCustomerUuidAccountNumberAndBalance(
        Uuid $uuid,
        Uuid $customerUuid,
        string $accountNumber,
        int $balance
    ): self {
        return new self($uuid, $customerUuid, $accountNumber, $balance);
    }

    public static function create(Uuid $customerUuid, string $accountNumber): self
    {
        return new self(Uuid::generate(), $customerUuid, $accountNumber, 0);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'customerUuid' => $this->customerUuid,
            'accountNumber' => $this->accountNumber,
            'balance' => $this->balance,
        ];
    }
}
