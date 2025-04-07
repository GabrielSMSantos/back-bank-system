<?php

namespace App\Modules\BankAccount\Domain\Services;

use App\Modules\BankAccount\Domain\Repositories\IBankAccountRepository;

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
