<?php

namespace App\Infrastructure\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = [
        'uuid',
        'cpf',
        'firstName',
        'lastName',
        'email',
        'cell',
        'birthDate',
    ];
}
