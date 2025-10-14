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

            $table->string('supporting_doc')->nullable()->after('aadhaar_no'); // Adjust 'id' to place after desired column
            $table->string('pan_no')->nullable()->after('supporting_doc');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->dropColumn(['supporting_doc', 'pan_no']);

        });
    }
};
