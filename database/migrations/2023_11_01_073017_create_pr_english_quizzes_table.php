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
        Schema::create('pr_english_quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('quiz');
            $table->string('photo')->default('no_photo');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('pr_english_topics');
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
        Schema::dropIfExists('pr_english_quizzes');
    }
};
