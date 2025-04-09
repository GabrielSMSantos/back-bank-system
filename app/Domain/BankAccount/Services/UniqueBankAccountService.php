<?php

namespace App\Domain\BankAccount\Services;

use App\Domain\BankAccount\Exceptions\BankAccountException;
use App\Domain\BankAccount\Repositories\IBankAccountRepository;
use App\ValueObjects\Uuid;

class UniqueBankAccountService
{
    public function __construct(
        private IBankAccountRepository $repository
    ) { }

    public function execute(Uuid $customerUuid): void
    {
        if ($this->repository->findByCustomerUuid($customerUuid)) {
            throw new BankAccountException('Este Cliente já possuí conta bancária.');
        }
    }
}
