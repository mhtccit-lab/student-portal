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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name_english');
            $table->string('full_name_bangla');
            $table->string('gender');
            $table->string('current_address');
            $table->string('permanent_address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->date('date_of_birth');
            $table->string('district');
            $table->string('police_station');
            $table->string('postal_code');
            $table->enum('types_of_card', ['nid','passport'])->default('passport');
            $table->string('card_number');
            $table->date('passport_expiry_date');
            $table->string('card_file');
            $table->string('photo');
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trade_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('reference_name');
            $table->integer('course_duration');
            $table->string('course_fee');
            $table->string('amount_receiver_name');            
            $table->enum('status', ['active','inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
