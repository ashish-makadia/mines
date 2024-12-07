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
        Schema::create('workinprogress', function (Blueprint $table) {
            $table->id();
            $table->string('wp_no')->nullable();
            $table->integer('target')->nullable();
            $table->integer('quc_id')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->integer('incharge_id')->nullable();
            $table->date('start_date')->nullable();
            $table->string('no_of_pieces')->nullable();
            $table->date('current_date')->nullable();
            $table->string('size_of_pic')->nullable();
            $table->string('pic_image')->nullable();
            $table->string('finish_good')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('gunfoot')->nullable();
            $table->string('waste_quantity')->nullable();
            $table->string('luffers_quantity')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workinprogress');
    }
};
