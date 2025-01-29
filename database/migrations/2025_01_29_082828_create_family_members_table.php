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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->date('dob')->nullable();
            $table->string('blood_group')->nullable();
            $table->boolean('married')->default(false);
            $table->date('marriage_date')->nullable();
            $table->string('spouse')->nullable();
            $table->string('job')->nullable();
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->string('job_location')->nullable();
            $table->string('contact_no_1')->nullable();
            $table->string('contact_no_2')->nullable();
            $table->string('email')->nullable();
            $table->date('baptism_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
