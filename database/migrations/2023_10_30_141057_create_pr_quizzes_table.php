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
        Schema::disableForeignKeyConstraints();

        Schema::create('pr_quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('quiz');
            $table->string('photo');
            $table->bigInteger('exam_day_id');
            $table->foreign('exam_day_id')->references('id')->on('pr__exam_days');
            $table->float('ball');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_quizzes');
    }
};
