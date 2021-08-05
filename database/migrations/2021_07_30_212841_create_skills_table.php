<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('skill_header')->nullable();
            $table->string('language_header')->nullable();
            $table->string('first_skill')->nullable();
            $table->string('first_skill_percent')->nullable();
            $table->string('second_skill')->nullable();
            $table->string('second_skill_percent')->nullable();
            $table->string('third_skill')->nullable();
            $table->string('third_skill_percent')->nullable();
            $table->string('first_language')->nullable();
            $table->string('first_language_percent')->nullable();
            $table->string('second_language')->nullable();
            $table->string('second_language_percent')->nullable();
            $table->string('third_language')->nullable();
            $table->string('third_language_percent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
    }
}
