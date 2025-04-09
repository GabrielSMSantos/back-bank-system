<?php

namespace App\Application\Customer\UseCases\DeleteCustomer;

use App\Domain\Customer\Repositories\ICustomerRepository;
use App\ValueObjects\Uuid;

class DeleteCustomerUseCase
{
    public function __construct(
        private ICustomerRepository $repository
    ) { }

    public function execute(Uuid $uuid): bool
    {
        return $this->repository->delete($uuid);
    }
}
