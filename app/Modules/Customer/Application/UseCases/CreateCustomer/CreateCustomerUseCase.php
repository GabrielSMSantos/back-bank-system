<?php

namespace App\Modules\Customer\Application\UseCases\CreateCustomer;

use App\Modules\Customer\Domain\Entities\Customer;
use App\Modules\Customer\Domain\Enums\Status;
use App\Modules\Customer\Domain\Repositories\ICustomerRepository;

class CreateCustomerUseCase
{
    public function __construct(
        private ICustomerRepository $repository
    ) { }

    public function execute(CreateCustomerDto $input): int
    {
        $customer = Customer::create(
            cpf: $input->cpf,
            name: $input->name,
            email: $input->email,
            cell: $input->cell,
            birthDate: $input->birthDate,
            status: Status::ACTIVE
        );
        return $this->repository->create($customer);
    }
}
