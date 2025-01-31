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
        Schema::create('school_details', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->string('school_name');
            $table->string('principal_name');
            $table->string('city_name');
            $table->string('district_name');
            $table->bigInteger('contact_no');
            $table->string('school_email');
            $table->integer('established_year');
            $table->string('school_website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_details');
    }
};
