<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_bank_accounts', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->cascadeOnDelete();

            $table->foreignId('bank_id')
                  ->constrained('bank_master')
                  ->cascadeOnDelete();

            // Account details
            $table->string('account_number', 30);
            $table->string('account_type', 50)->nullable(); // Savings, Current, FD, Loan, etc.
            $table->string('ifsc_code', 20)->nullable();
            $table->string('branch_name', 150)->nullable();
            $table->date('account_creation_date')->nullable();
            $table->string('passbook_received', 3)->default('No'); // Yes/No
            $table->string('atm_received', 3)->default('No');

            // Primary account flag
            $table->boolean('is_primary')->default(false);

            $table->timestamps();

            // Ensure uniqueness of account_number per customer+bank
            $table->unique(['customer_id', 'bank_id', 'account_number'], 'uniq_customer_bank_account');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_bank_accounts', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['bank_id']);
        });

        Schema::dropIfExists('customer_bank_accounts');

    }
};
