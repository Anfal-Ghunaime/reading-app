<?php

use Carbon\Carbon;
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
        Schema::create('with_shelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelf_id')
                ->constrained('shelves')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->morphs('relatable');
            $table->date('time')->default(Carbon::now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('with_shelves');
    }
};
