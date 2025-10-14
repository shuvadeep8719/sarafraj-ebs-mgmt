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

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('mobile_no', 15)->unique();
            $table->string('alternate_no', 15)->nullable();
            $table->text('addr_details')->nullable();
            $table->string('location', 100)->nullable();
            $table->string('aadhaar_no', 20)->nullable()->unique();
            $table->string('user_identification_mark', 255)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('age_classification', 10)->nullable();

            // Relation to bank
            $table->foreignId('bank_id')
                  ->constrained('bank_master')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first, then the table
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
        });
        Schema::dropIfExists('customers');

    }
};
