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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->integer('phone')->nullable();
            $table->string('email')->unique();
            $table->string('car_model')->nullable();
            $table->string('car_year')->nullable();
            $table->date('appointment_data')->nullable();
            $table->time('appointment_time')->nullable();
            $table->string('service_type')->nullable();
            $table->string('service_package')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('inspection')->default(false);
            $table->boolean('wash')->default(false);
            $table->boolean('detailing')->default(false);
            $table->boolean('final_touches')->default(false);
            $table->boolean('completion')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
