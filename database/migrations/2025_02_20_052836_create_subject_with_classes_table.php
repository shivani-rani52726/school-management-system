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
        Schema::create('subject_with_classes', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->uuid('class')->nullable();
            $table->foreign('class')->references('uuid')->on('class_students')->onDelete('cascade');
            $table->string('subject_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_with_classes');
    }
};
