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
        Schema::create('student_details', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->string('stu_name');
            $table->integer('rollNo');
            $table->string('class');
            $table->string('father_name');
            $table->string('mother_name');
            $table->bigInteger('aadhar_number');
            $table->text('address');
            $table->bigInteger('contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_details');
    }
};
