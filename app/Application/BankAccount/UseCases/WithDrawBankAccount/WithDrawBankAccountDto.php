<?php

namespace App\Application\BankAccount\UseCases\WithDrawBankAccount;

use App\ValueObjects\Uuid;

final class WithDrawBankAccountDto
{
    public function __construct(
        public Uuid $uuid,
        public int $value
    ) { }
}
