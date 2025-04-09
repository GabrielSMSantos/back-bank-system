<?php

namespace App\Application\BankAccount\UseCases\CreateBankAccount;

use App\Domain\BankAccount\Entities\BankAccount;
use App\Domain\BankAccount\Repositories\IBankAccountRepository;
use App\Domain\BankAccount\Services\GenerateAccountNumberService;
use App\Domain\BankAccount\Services\UniqueBankAccountService;
use App\ValueObjects\Uuid;

class CreateBankAccountUseCase
{
    public function __construct(
        private IBankAccountRepository $repository,
        private UniqueBankAccountService $uniqueBankAccountService,
        private GenerateAccountNumberService $generateAccountNumberService
    ) { }

    public function execute(Uuid $customerUuid): int
    {
        $this->uniqueBankAccountService->execute($customerUuid);
        $accountNumber = $this->generateAccountNumberService->execute();
        $bankAccount = BankAccount::create(
            $customerUuid,
            $accountNumber
        );
        return $this->repository->create($bankAccount);
    }
}
