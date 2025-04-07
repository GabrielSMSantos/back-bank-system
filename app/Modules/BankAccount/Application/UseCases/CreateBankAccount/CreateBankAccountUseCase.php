<?php

namespace App\Modules\BankAccount\Application\UseCases\CreateBankAccount;

use App\Modules\BankAccount\Domain\Entities\BankAccount;
use App\Modules\BankAccount\Domain\Repositories\IBankAccountRepository;
use App\Modules\BankAccount\Domain\Services\GenerateAccountNumberService;
use App\Modules\BankAccount\Domain\Services\UniqueBankAccountService;
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
