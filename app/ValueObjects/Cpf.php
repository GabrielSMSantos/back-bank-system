<?php

namespace App\ValueObjects;

use InvalidArgumentException;
use Stringable;

final class Cpf implements Stringable
{
    private string $value;
    public function __construct(string $cpf)
    {
        $this->setCpf($cpf);
    }

    private function setCpf(string $cpf): void
    {
        if (strlen($cpf) != 14) {
            throw new InvalidArgumentException('O Cpf deve conter 14 caracteres.');
        }
        if (in_array($cpf, [
            '111.111.111-11',
            '222.222.222-22',
            '333.333.333-33',
            '444.444.444-44',
            '555.555.555-55',
            '666.666.666-66',
            '777.777.777-77',
            '888.888.888-88',
            '999.999.999-99',
        ])) {
            throw new InvalidArgumentException('Cpf informado é inválido.');
        }
        if (!preg_match('/\d{3}[\.]\d{3}[\.]\d{3}[\-]\d{2}/', $cpf)) {
            throw new InvalidArgumentException('Cpf informado é inválido.');
        }
        if (!$this->validateCpf($cpf)) {
            throw new InvalidArgumentException('Cpf informado é inválido.');
        }
        $this->value = $cpf;
    }

    private function sanitize(string $cpf): string
    {
        $sanitized = str_replace('.', '', $cpf);
        $sanitized = str_replace('-', '', $sanitized);
        return $sanitized;
    }

    private function getDigit(int $loopLength, string $cpf): string
    {
        $multipliers = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        $sum = 0;
        for ($index = 0; $index < $loopLength; $index++) {
            $sum += $multipliers[$index] * $cpf[$index];
        }
        $result = $sum % 11;
        return $result < 2 ? 0 : 11 - $result;
    }

    private function validateCpf(string $cpf): bool
    {
        $isValid = false;
        $cpfSanitized = $this->sanitize($cpf);

        $subStrtoValidateFirstDigit = substr($cpfSanitized, 0, 9);
        $subStrToValidateSecondDigit = substr($cpfSanitized, 0, 10);

        $firstDigit = $this->getDigit(strlen($subStrtoValidateFirstDigit), strrev($subStrtoValidateFirstDigit));
        $secondDigit = $this->getDigit(strlen($subStrToValidateSecondDigit), strrev($subStrToValidateSecondDigit));
        if ($firstDigit == $cpfSanitized[-2] && $secondDigit == $cpfSanitized[-1]) {
            $isValid = true;
        }
        return $isValid;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
