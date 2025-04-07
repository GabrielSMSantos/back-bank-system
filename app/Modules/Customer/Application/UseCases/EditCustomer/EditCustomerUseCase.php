<?php

namespace App\Modules\Customer\Application\UseCases\EditCustomer;

use App\Modules\Customer\Domain\Entities\Customer;
use App\Modules\Customer\Domain\Repositories\ICustomerRepository;

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
