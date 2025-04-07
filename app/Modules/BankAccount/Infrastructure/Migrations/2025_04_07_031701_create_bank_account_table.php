<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bank_account', function (Blueprint $table) {
            $table->uuid();
            $table->uuid('customer_uuid');
            $table->string('account_number', 5)->unique();
            $table->bigInteger('balance');
            $table->smallInteger('status');
            $table->timestamps();

            $table->foreign('customer_uuid')->references('uuid')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_account');
    }
};
