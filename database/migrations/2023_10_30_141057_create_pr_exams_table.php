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

        Schema::create('pr_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_day_id');
            $table->foreign('exam_day_id')->references('id')->on('pr__exam_days');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('quiz_count');
            $table->bigInteger('correct');
            $table->bigInteger('incorrect');
            $table->bigInteger('status');
            $table->text('json_result');
            $table->string('promocode');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_exams');
    }
};
