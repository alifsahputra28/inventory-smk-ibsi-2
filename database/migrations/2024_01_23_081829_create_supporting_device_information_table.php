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
        Schema::create('supporting_device_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_supporting_device_id')->constrained('data_supporting_devices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('laboratory_room_id')->constrained('laboratory_rooms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('supporting_device_number');
            $table->integer('amount');
            $table->string('condition');
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supporting_device_information');
    }
};
