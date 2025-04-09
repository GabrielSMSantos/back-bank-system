<?php

namespace Tests\Feature\Application\BankAccount\UseCases\WithdrawBankAccount;

use App\Application\BankAccount\UseCases\WithDrawBankAccount\WithDrawBankAccountDto;
use App\Application\BankAccount\UseCases\WithDrawBankAccount\WithDrawBankAccountUseCase;
use App\Domain\BankAccount\Repositories\IBankAccountRepository;
use App\ValueObjects\Uuid;
use Illuminate\Foundation\Testing\TestCase;

class WithdrawBankAccountUseCaseTest extends TestCase
{
    public function test_withdraw_bank_account(): void
    {
        $input = new WithDrawBankAccountDto(
            uuid: new Uuid('0f766b40-73ed-4750-b9f7-0cdc1358b79c'),
            value: 123
        );

        $repository = $this->createMock(IBankAccountRepository::class);
        $repository->expects($this->once())->method('edit')->willReturn(true);

        $useCase = new WithDrawBankAccountUseCase($repository);
        $output = $useCase->execute($input);
        $this->assertTrue($output);
    }
}
