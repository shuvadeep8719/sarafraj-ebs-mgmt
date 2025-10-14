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

        Schema::create('customer_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->cascadeOnDelete();

            $table->string('doc_type', 50); // e.g., PAN, Form60, Aadhaar
            $table->string('file_path');    // storage path of file
            $table->string('file_type', 20)->nullable(); // image/pdf
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_documents', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('customer_documents');

    }
};
