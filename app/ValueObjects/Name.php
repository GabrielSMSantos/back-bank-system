<?php

namespace App\ValueObjects;

use App\Exceptions\NameInvalidException;
use InvalidArgumentException;

final class Name
{
    private string $firstName;
    private string $lastName;
    public function __construct(
        string $firstName,
        string $lastName,
    ) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    private function setFirstName(string $firstName): void
    {
        if (strlen($firstName) < 3) {
            throw new InvalidArgumentException('O Nome deve conter no mínimo 3 caracteres.');
        }
        if (strlen($firstName) > 80) {
            throw new InvalidArgumentException('O Nome deve conter no máximo 80 caracteres.');
        }
        if (preg_match_all('/[^a-zA-Z ]/', $firstName)) {
            throw new InvalidArgumentException('O Nome deve conter apenas letras.');
        }

        $this->firstName = $firstName;
    }

    private function setLastName(string $lastName): void
    {
        if (strlen($lastName) < 3) {
            throw new InvalidArgumentException('O Sobrenome deve conter no mínimo 3 caracteres.');
        }
        if (strlen($lastName) > 80) {
            throw new InvalidArgumentException('O Sobrenome deve conter no máximo 80 caracteres.');
        }
        if (preg_match_all('/[^a-zA-Z ]/', $lastName)) {
            throw new InvalidArgumentException('O Sobrenome deve conter apenas letras.');
        }

        $this->lastName = $lastName;
    }

}
