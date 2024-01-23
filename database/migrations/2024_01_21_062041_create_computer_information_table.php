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
        Schema::create('computer_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_computer_id')->constrained('data_computers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('laboratory_room_id')->constrained('laboratory_rooms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('computer_number');
            $table->date('date');
            $table->integer('amount');
            $table->string('condition');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_information');
    }
};
