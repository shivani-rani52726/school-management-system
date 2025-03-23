<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('student_name'); // Student ka naam
            $table->date('date'); // Attendance ki date
            $table->string('subject'); // Subject ka naam
            $table->enum('status', ['Present', 'Absent']); // Attendance status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};

