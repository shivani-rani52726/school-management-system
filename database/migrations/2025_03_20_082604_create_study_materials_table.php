<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('material_type'); // notes, assignment, quiz, etc.
            $table->string('class_name');
            $table->string('subject_name');
            $table->date('due_date')->nullable(); // Only for assignments & quizzes
            $table->string('file_name')->nullable(); // Store only the file name
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('study_materials');
    }
};

