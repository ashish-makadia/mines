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
        // Schema::create('sale_assets', function (Blueprint $table) {
        //     $table->id();
        //     $table->date('sales_date')->nullable();
        //     $table->string('assets_type')->nullable();
        //     $table->bigInteger('assets_category')->default(0);
        //     $table->string('assets_name')->nullable();
        //     $table->double('quantity')->nullable();
        //     $table->bigInteger('mine_id')->default(0);
        //     $table->string('transfer_mine_name')->nullable();
        //     $table->text('remarks')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale__assets');
    }
};
