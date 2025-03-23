<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('subject');
            $table->integer('marks_obtained');
            $table->integer('total_marks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
};
