<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('student_id')->unique();
            $table->decimal('total_fees', 10, 2);
            $table->decimal('paid_fees', 10, 2);
            $table->decimal('due_fees', 10, 2);
            $table->date('due_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};

