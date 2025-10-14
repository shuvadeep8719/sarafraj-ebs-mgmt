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

        Schema::table('customers', function (Blueprint $table) {
            // First drop foreign key if it exists
            if (Schema::hasColumn('customers', 'bank_id')) {
                $table->dropForeign(['bank_id']);
                $table->dropColumn('bank_id');
            }
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('customers', function (Blueprint $table) {
            // Re-add bank_id column + foreign key if rollback is needed
            $table->foreignId('bank_id')->nullable()->constrained('banks')->cascadeOnDelete();
        });

    }
};
