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
        Schema::create('laboratory_supporting_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laboratory_room_id')->constrained('laboratory_rooms');
            $table->string('supporting_device_number');
            $table->string('condition');
            $table->date('date');
            $table->text('description')->nullable();
            $table->string('name');
            $table->string('merk');
            $table->string('model_or_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_supporting_devices');
    }
};
