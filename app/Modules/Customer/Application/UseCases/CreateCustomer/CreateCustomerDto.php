<?php

namespace App\Modules\Customer\Application\UseCases\CreateCustomer;

use App\ValueObjects\Cell;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use DateTime;

final class CreateCustomerDto
{
    public function __construct(
        public Cpf $cpf,
        public Name $name,
        public Email $email,
        public Cell $cell,
        public DateTime $birthDate
    ) { }
}
