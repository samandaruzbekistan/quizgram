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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phone');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('admins')
            ->insert([
                'username' => 'saman',
                'password' => 'admin',
                'fullname' => 'Samandar Sariboyev',
                'phone' => '998975672009'
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
