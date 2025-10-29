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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')                    // Foreign key relationship to users table
            ->constrained()                           // Assumes users.id
            ->onDelete('cascade')                     // If user deleted, delete order
            ->onUpdate('cascade');                    // If user id updated, update here
            $table->float('total_price', 6, 2);             // Total order price (e.g., 120.99)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
