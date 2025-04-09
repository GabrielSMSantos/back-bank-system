<?php

namespace App\Application\Customer\UseCases\CreateCustomer;

use App\Domain\Customer\Entities\Customer;
use App\Domain\Customer\Repositories\ICustomerRepository;

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
        );
        return $this->repository->create($customer);
    }
}
