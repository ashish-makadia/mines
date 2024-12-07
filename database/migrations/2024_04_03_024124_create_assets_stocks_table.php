<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  ALTER TABLE `mines` ADD `area_unit` INT NOT NULL AFTER `mine_area`;
    public function up(): void
    {
        Schema::create('assets_stocks', function (Blueprint $table) {
            $table->id();
            $table->string("working_assets");
            $table->string("item_name");
            $table->text("description");
            $table->double("quantity");
            $table->integer("volume");
            $table->double("reorder_quantity");
            $table->double("remarks");
            $table->string("description");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_stocks');
    }
};
