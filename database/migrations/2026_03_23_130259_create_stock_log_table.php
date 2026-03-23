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
        Schema::create('stock_log', function (Blueprint $table) {
            $table->string('stockId')->primary();
            $table->string('binId');
            $table->string('itemId');

            $table->foreign('binId')->references('binId')->on('bins')->onDelete('cascade');
            $table->foreign('itemId')->references('itemId')->on('items')->onDelete('cascade');
            
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_log');
    }
};
