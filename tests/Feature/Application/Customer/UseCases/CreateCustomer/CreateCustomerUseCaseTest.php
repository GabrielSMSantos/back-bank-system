<?php

namespace Tests\Feature\Application\Customer\UseCases\CreateCustomer;

use App\Application\Customer\UseCases\CreateCustomer\CreateCustomerDto;
use App\Application\Customer\UseCases\CreateCustomer\CreateCustomerUseCase;
use App\Domain\Customer\Repositories\ICustomerRepository;
use Illuminate\Foundation\Testing\TestCase;
use App\ValueObjects\Name;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use App\ValueObjects\Cell;
use DateTime;
use InvalidArgumentException;

class CreateCustomerUseCaseTest extends TestCase
{
    public function test_customer_was_created(): void
    {
        $input = new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );

        $repository = $this->createMock(ICustomerRepository::class);
        $repository->expects($this->once())->method('create')->willReturn(1);

        $useCase = new CreateCustomerUseCase($repository);
        $output = $useCase->execute($input);
        $this->assertEquals(1, $output);
    }

    public function test_invalid_length_cpf_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Cpf deve conter 14 caracteres.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('123'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_equal_numbers_in_cpf_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cpf informado é inválido.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('111.111.111-11'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_non_standard_cpf_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cpf informado é inválido.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('1*s.ssd.#!@-%&'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_invalid_cpf_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cpf informado é inválido.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('123.456.789-10'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_invalid_email_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('E-Mail informado é inválido.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('emailteste'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_invalid_cell_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Celular informado é inválido.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('abc'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_invalid_ddd_cell_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('DDD do Celular informado é inválido.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(10) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_birthdate_greater_than_or_equal_to_today_throw_exception(): void
    {
        $input = new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime()
        );

        $repository = $this->createMock(ICustomerRepository::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Data de nascimento informada é inválida.');
        $useCase = new CreateCustomerUseCase($repository);
        $useCase->execute($input);
    }

    public function test_birthdate_younger_throw_exception(): void
    {
        $input = new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2010-01-01')
        );

        $repository = $this->createMock(ICustomerRepository::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('É necessário ter mais de 18 anos.');
        $useCase = new CreateCustomerUseCase($repository);
        $useCase->execute($input);
    }

    public function test_name_less_than_minimum_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Nome deve conter no mínimo 3 caracteres.');
        new CreateCustomerDto(
            name: new Name('ab', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }


    public function test_name_greater_than_maximum_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Nome deve conter no máximo 80 caracteres.');
        new CreateCustomerDto(
            name: new Name('Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Ab, neque tenetur ipsum inventore sapiente sint eligendi iusto eum nostrum
            adipisci officiis qui odit, voluptas placeat dolorum voluptatibus amet iure
            libero nam? Nesciunt ex veritatis libero itaque laborum, neque nemo ipsa error
            nam eum! Atque incidunt deserunt laboriosam consectetur maxime inventore exercitationem
            architecto tenetur, quasi maiores placeat voluptatum earum esse eligendi impedit expedita
            assumenda molestias, sint, iste vitae! Doloribus, facere, voluptatem libero facilis dolorum
            illo, quisquam iusto fuga error iure earum itaque?', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_name_with_number_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Nome deve conter apenas letras.');
        new CreateCustomerDto(
            name: new Name('Lorem 123', 'De Teste'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_lastName_less_than_minimum_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Sobrenome deve conter no mínimo 3 caracteres.');
        new CreateCustomerDto(
            name: new Name('Client', 'ab'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }


    public function test_lastName_greater_than_maximum_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Sobrenome deve conter no máximo 80 caracteres.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Ab, neque tenetur ipsum inventore sapiente sint eligendi iusto eum nostrum
            adipisci officiis qui odit, voluptas placeat dolorum voluptatibus amet iure
            libero nam? Nesciunt ex veritatis libero itaque laborum, neque nemo ipsa error
            nam eum! Atque incidunt deserunt laboriosam consectetur maxime inventore exercitationem
            architecto tenetur, quasi maiores placeat voluptatum earum esse eligendi impedit expedita
            assumenda molestias, sint, iste vitae! Doloribus, facere, voluptatem libero facilis dolorum
            illo, quisquam iusto fuga error iure earum itaque?'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }

    public function test_lastName_with_number_throw_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('O Sobrenome deve conter apenas letras.');
        new CreateCustomerDto(
            name: new Name('Cliente', 'De Teste 123'),
            cpf: new Cpf('025.417.040-46'),
            email: new Email('cliente@teste.com.br'),
            cell: new Cell('(11) 91234-5678'),
            birthDate: new DateTime('2000-01-01')
        );
    }
}
