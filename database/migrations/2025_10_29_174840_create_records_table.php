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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')                       // Foreign key relationship to genres table
            ->constrained()                               // Assumes genres.id
            ->onDelete('cascade')                         // If genre deleted, delete record
            ->onUpdate('cascade');                        // If genre id updated, update here
            $table->string('artist')->collation('nocase');      // Artist name, case-insensitive
            $table->string('title')->collation('nocase');       // Record title, case-insensitive
            $table->string('mb_id', 36)->nullable()->unique();  // MusicBrainz ID (nullable, unique, 36 chars)
            $table->float('price', 5, 2)->default(19.99);       // Price, default 19.99
            $table->unsignedInteger('stock')->default(1);       // Stock level, default 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
