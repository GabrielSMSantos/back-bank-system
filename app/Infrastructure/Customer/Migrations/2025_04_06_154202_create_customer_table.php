<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->uuid();
            $table->string('cpf', 14)->unique();
            $table->string('firstName', 80);
            $table->string('lastName', 80);
            $table->string('email', 255);
            $table->string('cell', 15);
            $table->date('birthDate');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
