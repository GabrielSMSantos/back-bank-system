<?php

namespace App\Infrastructure\Customer\Repositories\Eloquent;

use App\Domain\Customer\Entities\Customer;
use App\Domain\Customer\Repositories\ICustomerRepository;
use App\Infrastructure\Customer\Models\Customer as Model;
use App\ValueObjects\Cell;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Uuid;
use DateTime;

class CustomerRepository implements ICustomerRepository
{
    public function create(Customer $entity): int
    {
        $customer = Model::create([
            $entity->getUuid(),
            ...$entity->toArray()
        ]);
        return $customer->id;
    }

    public function edit(Customer $entity): bool
    {
        return Model::where('uuid', $entity->getUuid())->update($entity->toArray());
    }

    public function find(Uuid $uuid): ?Customer
    {
        $customer = Model::where('uuid', $uuid)->first();
        if (!$customer) {
            return null;
        }

        return Customer::withUuidCpfNameEmailCellAndBirthDate(
            new Uuid($customer->uuid),
            new Cpf($customer->cpf),
            new Name($customer->firstName, $customer->lastName),
            new Email($customer->email),
            new Cell($customer->cell),
            new DateTime($customer->birthDate),
        );
    }

    public function delete(Uuid $uuid): bool
    {
        return Model::where('uuid', $uuid)->delete();
    }
}
