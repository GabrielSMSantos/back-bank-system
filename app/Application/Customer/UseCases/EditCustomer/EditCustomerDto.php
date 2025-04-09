<?php

namespace App\Application\Customer\UseCases\EditCustomer;

use App\ValueObjects\Cell;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Uuid;
use DateTime;

final class EditCustomerDto
{
    public function __construct(
        public Uuid $uuid,
        public Cpf $cpf,
        public Name $name,
        public Email $email,
        public Cell $cell,
        public DateTime $birthDate,
    ) { }
}
