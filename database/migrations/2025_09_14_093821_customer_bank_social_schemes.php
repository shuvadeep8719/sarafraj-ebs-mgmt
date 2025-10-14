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

        Schema::create('customer_bank_social_schemes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_bank_account_id')
                  ->constrained('customer_bank_accounts')
                  ->cascadeOnDelete();

            $table->foreignId('social_scheme_id')
                  ->constrained('social_scheme_master')
                  ->cascadeOnDelete();


            // Status fields
            $table->boolean('is_active')->default(false);
            $table->date('activation_date')->nullable();
            $table->date('deactivation_date')->nullable();


            $table->timestamps();

            $table->unique(['customer_bank_account_id', 'social_scheme_id'], 'uniq_account_scheme');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_bank_social_schemes', function (Blueprint $table) {
            $table->dropForeign(['customer_bank_account_id']);
            $table->dropForeign(['social_scheme_id']);
        });
        Schema::dropIfExists('customer_bank_social_schemes');
    }
};
