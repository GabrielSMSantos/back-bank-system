<?php

namespace App\Domain\Customer\Entities;

use App\ValueObjects\Cell;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Uuid;
use DateTime;
use InvalidArgumentException;

final class Customer
{
    private function __construct(
        private Uuid $uuid,
        private Cpf $cpf,
        private Name $name,
        private Email $email,
        private Cell $cell,
        private DateTime $birthDate,
    ) { }

    public static function withUuidCpfNameEmailCellAndBirthDate(
        Uuid $uuid,
        Cpf $cpf,
        Name $name,
        Email $email,
        Cell $cell,
        DateTime $birthDate,
    ): self
    {
        return new Customer($uuid, $cpf, $name, $email, $cell, $birthDate);
    }

    public static function create(
        Cpf $cpf,
        Name $name,
        Email $email,
        Cell $cell,
        DateTime $birthDate,
    ): self {
        $today = new DateTime();
        if ($birthDate->setTime(0, 0, 0, 0) >= $today->setTime(0, 0, 0, 0)) {
            throw new InvalidArgumentException('Data de nascimento informada é inválida.');
        }
        if (strval($birthDate->setTime(0, 0, 0, 0)->diff($today->setTime(0, 0, 0, 0))->format('%y')) < 18) {
            throw new InvalidArgumentException('É necessário ter mais de 18 anos.');
        }

        return new self(Uuid::generate(), $cpf, $name, $email, $cell, $birthDate);
    }

    public static function edit(
        Uuid $uuid,
        Cpf $cpf,
        Name $name,
        Email $email,
        Cell $cell,
        DateTime $birthDate,
    ): self {
        $today = new DateTime();
        if ($birthDate->setTime(0, 0, 0, 0) >= $today->setTime(0, 0, 0, 0)) {
            throw new InvalidArgumentException('Data de nascimento informada é inválida.');
        }
        if (strval($birthDate->setTime(0, 0, 0, 0)->diff($today->setTime(0, 0, 0, 0))->format('%y')) < 18) {
            throw new InvalidArgumentException('É necessário ter mais de 18 anos.');
        }

        return new self($uuid, $cpf, $name, $email, $cell, $birthDate);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }
    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCell(): string
    {
        return $this->cell;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'cpf' => $this->cpf,
            'firstName' => $this->name->getFirstName(),
            'lastName' => $this->name->getLastName(),
            'email' => $this->email,
            'cell' => $this->cell,
            'birthDate' => $this->birthDate,
        ];
    }
}
