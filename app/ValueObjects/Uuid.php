<?php

namespace App\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Illuminate\Support\Str;
use Stringable;

final class Uuid implements Stringable
{
    private string $value;
    public function __construct(string $uuid)
    {
        $this->setUuid($uuid);
    }

    private function setUuid(string $uuid): void
    {
        if (!RamseyUuid::isValid($uuid)) {
            throw new InvalidArgumentException('Uuid informado é inválido.');
        }

        $this->value = $uuid;
    }

    public static function generate(): self
    {
        return new self(Str::uuid()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
