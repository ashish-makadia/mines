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
        Schema::create('diesel_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->bigInteger('diesel_stock_at')->default(0);
            $table->bigInteger('capacity_storage')->default(0);
            $table->double('stock')->nullable();
            $table->double('rate_per_ltr')->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diesel_stocks');
    }
};
