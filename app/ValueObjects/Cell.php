<?php

namespace App\ValueObjects;

use InvalidArgumentException;
use Stringable;

final class Cell implements Stringable
{
    private string $value;
    public function __construct(string $cell)
    {
        $this->setCell($cell);
    }

    private function setCell(string $cell): void
    {
        if (!preg_match('/[\(]\d{2}[\)] [\9]\d{4}[\-]\d{4}/', $cell)) {
            throw new InvalidArgumentException('Celular informado é inválido.');
        }

        if (!in_array(substr($cell, 1, 2), [
            '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '21', '22', '24',
            '27', '28',
            '31', '32', '33', '34', '35', '37', '38',
            '41', '42', '43', '44', '45', '46',
            '47', '48', '49',
            '51', '53', '54', '55',
            '61', '62', '63', '64',
            '65', '66', '67',
            '68', '69',
            '71', '73', '74', '75', '77',
            '79',
            '81', '82', '83', '84', '85', '86', '87', '88', '89',
            '91', '92', '93', '94', '95', '96', '97', '98', '99'
        ])) {
            throw new InvalidArgumentException('DDD do Celular informado é inválido.');
        }

        $this->value = $cell;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
