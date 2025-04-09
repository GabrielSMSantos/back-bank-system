<?php

namespace App\Infrastructure\Customer\Presentation\Http\Controllers;

use App\Application\Customer\UseCases\CreateCustomer\CreateCustomerDto;
use App\Application\Customer\UseCases\CreateCustomer\CreateCustomerUseCase;
use App\Application\Customer\UseCases\DeleteCustomer\DeleteCustomerUseCase;
use App\Application\Customer\UseCases\EditCustomer\EditCustomerDto;
use App\Application\Customer\UseCases\EditCustomer\EditCustomerUseCase;
use App\Application\Customer\UseCases\FindCustomer\FindCustomerUseCase;
use App\Infrastructure\Customer\Presentation\Http\Requests\CreateCustomerRequest;
use App\Infrastructure\Customer\Presentation\Http\Requests\DeleteCustomerRequest;
use App\Infrastructure\Customer\Presentation\Http\Requests\EditCustomerRequest;
use App\Infrastructure\Customer\Presentation\Http\Requests\FindCustomerRequest;
use App\ValueObjects\Cell;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Uuid;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CustomerController
{
    public function create(CreateCustomerRequest $request, CreateCustomerUseCase $useCase): JsonResponse
    {
        try {
            $output = $useCase->execute(new CreateCustomerDto(
                cpf: new Cpf($request->cpf),
                name: new Name($request->firstName, $request->lastName),
                email: new Email($request->email),
                cell: new Cell($request->cell),
                birthDate: new DateTime($request->birthDate),
            ));
            return response()->json([
                'success' => true,
                'message' => 'Sucesso ao criar cliente.',
                'data' =>  $output
            ]);
        } catch(Exception $e) {
            Log::error($e->getMessage(), ['CustomerController -> create']);
            return response()->json([
                'success' => false,
                'message' => 'Algo ocorreu de errado, tente novamente mais tarde',
                'data' =>  null
            ], 500);
        }
    }

    public function edit(EditCustomerRequest $request, EditCustomerUseCase $useCase): JsonResponse
    {
        try {
            $output = $useCase->execute(new EditCustomerDto(
                uuid: new Uuid($request->uuid),
                cpf: new Cpf($request->cpf),
                name: new Name($request->firstName, $request->lastName),
                email: new Email($request->email),
                cell: new Cell($request->cell),
                birthDate: new DateTime($request->birthDate),
            ));
            return response()->json([
                'success' => true,
                'message' => 'Sucesso ao editar cliente.',
                'data' =>  $output
            ]);
        } catch(Exception $e) {
            Log::error($e->getMessage(), ['CustomerController -> edit']);
            return response()->json([
                'success' => false,
                'message' => 'Algo ocorreu de errado, tente novamente mais tarde',
                'data' =>  null
            ], 500);
        }
    }

    public function find(FindCustomerRequest $request, FindCustomerUseCase $useCase): JsonResponse
    {
        try {
            $output = $useCase->execute(new Uuid($request->uuid));
            return response()->json([
                'success' => true,
                'message' => 'Sucesso ao buscar cliente.',
                'data' =>  $output
            ]);
        } catch(Exception $e) {
            Log::error($e->getMessage(), ['CustomerController -> find']);
            return response()->json([
                'success' => false,
                'message' => 'Algo ocorreu de errado, tente novamente mais tarde',
                'data' =>  null
            ], 500);
        }
    }

    public function delete(DeleteCustomerRequest $request, DeleteCustomerUseCase $useCase): JsonResponse
    {
        try {
            $output = $useCase->execute(new Uuid($request->uuid));
            return response()->json([
                'success' => true,
                'message' => 'Sucesso ao deletar cliente.',
                'data' =>  $output
            ]);
        } catch(Exception $e) {
            Log::error($e->getMessage(), ['CustomerController -> delete']);
            return response()->json([
                'success' => false,
                'message' => 'Algo ocorreu de errado, tente novamente mais tarde',
                'data' =>  null
            ], 500);
        }
    }
}
