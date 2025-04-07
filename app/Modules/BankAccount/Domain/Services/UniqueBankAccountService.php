<?php

namespace App\Modules\BankAccount\Domain\Services;

use App\Modules\BankAccount\Domain\Repositories\IBankAccountRepository;
use App\Modules\BankAccount\Exceptions\BankAccountException;
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
