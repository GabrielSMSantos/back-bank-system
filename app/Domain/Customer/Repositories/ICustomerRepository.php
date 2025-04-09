<?php

namespace App\Domain\Customer\Repositories;

use App\Domain\Customer\Entities\Customer;
use App\ValueObjects\Uuid;

interface ICustomerRepository
{
    public function create(Customer $entity): int;
    public function edit(Customer $entity): bool;
    public function find(Uuid $uuid): ?Customer;
    public function delete(Uuid $uuid): bool;
}
