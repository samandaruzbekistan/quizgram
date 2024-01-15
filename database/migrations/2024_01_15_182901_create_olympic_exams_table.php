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
        Schema::create('olympic_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_day_id');
            $table->foreign('exam_day_id')->references('id')->on('olympic_days');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->bigInteger('quiz_count');
            $table->bigInteger('correct');
            $table->bigInteger('incorrect');
            $table->bigInteger('status');
            $table->text('json_result');
            $table->string('promocode');
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
        Schema::dropIfExists('olympic_exams');
    }
};
