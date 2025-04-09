<?php

namespace App\Application\BankAccount\UseCases\WithDrawBankAccount;

use App\Domain\BankAccount\Repositories\IBankAccountRepository;

class WithDrawBankAccountUseCase
{
    public function __construct(
        private IBankAccountRepository $repository
    ) { }

    public function execute(WithDrawBankAccountDto $input): bool
    {
        // TO DO
        return true;
    }
}
