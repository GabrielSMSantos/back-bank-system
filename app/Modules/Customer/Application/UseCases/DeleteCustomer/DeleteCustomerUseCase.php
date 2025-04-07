<?php

namespace App\Modules\Customer\Application\UseCases\DeleteCustomer;

use App\Modules\Customer\Domain\Repositories\ICustomerRepository;
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
