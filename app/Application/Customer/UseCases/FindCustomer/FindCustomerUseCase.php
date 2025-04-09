<?php

namespace App\Application\Customer\UseCases\FindCustomer;

use App\Domain\Customer\Entities\Customer;
use App\Domain\Customer\Repositories\ICustomerRepository;
use App\ValueObjects\Uuid;

class FindCustomerUseCase
{
    public function __construct(
        private ICustomerRepository $repository
    ) { }

    public function execute(Uuid $uuid): ?Customer
    {
        return $this->repository->find($uuid);
    }
}
