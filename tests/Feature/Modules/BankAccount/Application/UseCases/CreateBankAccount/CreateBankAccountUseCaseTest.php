<?php

namespace Tests\Feature\Modules\BankAccount\Application\UseCases\CreateBankAccount;

use App\Modules\BankAccount\Application\UseCases\CreateBankAccount\CreateBankAccountUseCase;
use App\Modules\BankAccount\Domain\Repositories\IBankAccountRepository;
use App\Modules\BankAccount\Domain\Services\GenerateAccountNumberService;
use App\Modules\BankAccount\Domain\Services\UniqueBankAccountService;
use App\ValueObjects\Uuid;
use Illuminate\Foundation\Testing\TestCase;

class CreateBankAccountUseCaseTest extends TestCase
{
    public function test_bank_account_was_created(): void
    {
        $repository = $this->createMock(IBankAccountRepository::class);
        $repository->expects($this->once())->method('create')->willReturn(1);

        $uniqueBankAccountService = $this->createMock(UniqueBankAccountService::class);

        $generateAccountNumberService = $this->createMock(GenerateAccountNumberService::class);
        $generateAccountNumberService->expects($this->once())->method('execute')->willReturn('12345');

        $customerUuid = '0f766b40-73ed-4750-b9f7-0cdc1358b79c';
        $useCase = new CreateBankAccountUseCase($repository, $uniqueBankAccountService, $generateAccountNumberService);
        $output = $useCase->execute(new Uuid($customerUuid));
        $this->assertEquals(1, $output);
    }
}
