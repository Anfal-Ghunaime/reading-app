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
        Schema::create('quotebook_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotebook_id')
                ->constrained('quotebooks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('quote_id')
                ->constrained('quotes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotebook_quotes');
    }
};
