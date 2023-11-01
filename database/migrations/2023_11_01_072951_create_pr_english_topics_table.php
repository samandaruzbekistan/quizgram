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
        Schema::create('pr_english_topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_day_id');
            $table->foreign('exam_day_id')->references('id')->on('pr_exam_days');
            $table->string('title');
            $table->text('topic');
            $table->string('note');
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
        Schema::dropIfExists('pr_english_topics');
    }
};
