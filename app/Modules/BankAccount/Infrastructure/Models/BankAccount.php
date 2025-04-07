<?php

namespace App\Modules\BankAccount\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    protected $table = 'bank_accounts';
    protected $fillable = [
        'uuid',
        'customer_uuid',
        'account_number',
        'balance',
        'status',
    ];
}
