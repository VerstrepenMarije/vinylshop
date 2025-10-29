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
        Schema::create('orderlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')                   // Foreign key relationship to orders table
            ->constrained()                           // Assumes orders.id
            ->onDelete('cascade')                     // If order deleted, delete line item
            ->onUpdate('cascade');                    // If order id updated, update here
            $table->string('artist')->collation('nocase');  // Copied from record at time of order
            $table->string('title')->collation('nocase');   // Copied from record at time of order
            $table->string('mb_id', 36)->nullable();        // Copied from record (nullable if original was null)
            $table->unsignedInteger('quantity');            // How many of this record were ordered
            $table->float('total_price', 6, 2);             // Price for this line (quantity * price_at_time_of_order)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderlines');
    }
};
