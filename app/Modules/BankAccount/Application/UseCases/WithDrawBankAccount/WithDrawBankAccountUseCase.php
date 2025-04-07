<?php

namespace App\Modules\BankAccount\Application\UseCases\WithDrawBankAccount;

use App\Modules\BankAccount\Domain\Repositories\IBankAccountRepository;

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
