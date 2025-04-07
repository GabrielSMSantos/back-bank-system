<?php

namespace App\Modules\Customer\Application\UseCases\FindCustomer;

use App\Modules\Customer\Domain\Entities\Customer;
use App\Modules\Customer\Domain\Repositories\ICustomerRepository;
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
