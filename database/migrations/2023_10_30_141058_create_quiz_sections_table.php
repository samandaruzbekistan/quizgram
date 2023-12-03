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
        Schema::create('quiz_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('topic');
            $table->string('photo')->default('no_photo');
            $table->unsignedBigInteger('exam_day_id');
            $table->foreign('exam_day_id')->references('id')->on('pr_exam_days');
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
        Schema::dropIfExists('quiz_sections');
    }
};
