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
        Schema::create('dispatch_registers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mine_id')->default(0);
            $table->bigInteger('issued_assets')->nullable();
            $table->double('quantity_issued')->nullable();
            $table->bigInteger('issued_by')->nullable();
            $table->text('issued_for')->nullable();
            $table->double('pending_quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_registers');
    }
};
