<?php

namespace App\Domain\BankAccount\Services;

use App\Domain\BankAccount\Repositories\IBankAccountRepository;

class GenerateAccountNumberService
{
    public function __construct(
        private IBankAccountRepository $repository
    ) { }

    public function execute(): string
    {
        $accountNumber = random_int(10000, 99999);
        if ($this->repository->findByAccountNumber($accountNumber)) {
            $this->execute();
        }
        return $accountNumber;
    }
}
