<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_id', 8)->unique();
            $table->string('book');
            $table->string('name');
            $table->string('writer');
            $table->string('cover')->nullable();
            $table->text('summary')->nullable();
            $table->integer('pages_num');
            $table->string('lang');
            $table->string('published_at')->nullable();
            $table->integer('num_of_readers')->nullable()->default(0);
            $table->double('stars')->default(0);
            $table->integer('num_of_voters')->default(0);
            $table->boolean('is_novel');
            $table->time('avg_read_time')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->double('points')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
