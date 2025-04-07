<?php

namespace App\ValueObjects;

use InvalidArgumentException;
use Stringable;

final class Email implements Stringable
{
    private string $value;
    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    private function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-Mail informado é inválido.');
        }
        $this->value = $email;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
