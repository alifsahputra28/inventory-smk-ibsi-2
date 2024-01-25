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
        Schema::create('laboratory_computers', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('data_computer_id')->constrained('data_computers');
            $table->foreignUuid('laboratory_room_id')->constrained('laboratory_rooms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('computer_number');
            $table->string('condition');
            $table->date('date');
            $table->text('description')->nullable();
            $table->string('merk');
            $table->string('model');
            $table->string('processor');
            $table->string('vga');
            $table->integer('ram');
            $table->integer('disk_size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_computers');
    }
};
