<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olympic_quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('quiz');
            $table->string('photo');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('olympic_quiz_sections');
            $table->float('ball');
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
        Schema::dropIfExists('olympic_quizzes');
    }
};
