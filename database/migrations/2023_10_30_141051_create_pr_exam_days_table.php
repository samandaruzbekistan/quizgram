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
        Schema::create('pr_exam_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('amount');
            $table->bigInteger('sales_amount');
            $table->bigInteger('status');
            $table->bigInteger('quiz_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_exam_days');
    }
};
