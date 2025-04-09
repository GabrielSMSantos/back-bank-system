<?php

namespace App\Application\Customer\UseCases\EditCustomer;

use App\Domain\Customer\Entities\Customer;
use App\Domain\Customer\Repositories\ICustomerRepository;

class EditCustomerUseCase
{
    public function __construct(
        private ICustomerRepository $repository
    ) {}

    public function execute(EditCustomerDto $input): bool
    {
        $customer = Customer::edit(
            uuid: $input->uuid,
            cpf: $input->cpf,
            name: $input->name,
            email: $input->email,
            cell: $input->cell,
            birthDate: $input->birthDate,
        );
        return $this->repository->edit($customer);
    }
}
