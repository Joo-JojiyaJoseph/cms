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
            $table->unsignedBigInteger('house_id');
            $table->string('full_name');
            $table->string('gender');
            $table->string('primary_contact');
            $table->string('secondary_contact')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->date('dob');
            $table->string('blood_group');
            $table->string('marital_status');
            $table->date('marriage_date')->nullable();
            $table->string('job');
            $table->string('current_job_location');
            $table->text('permanent_address');
            $table->text('present_address');
            $table->boolean('same_as_permanent')->default(false);
            $table->string('baptism_name')->nullable();
            $table->date('baptism_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('relationship')->default('Unknown');   // Add Relationship Field
            $table->date('member_of_parish_since')->nullable(); // Add Parish Membership Date

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
