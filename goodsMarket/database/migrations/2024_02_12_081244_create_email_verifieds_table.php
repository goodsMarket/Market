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
        Schema::create('email_verifieds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id'); // 유저 pk
            $table->timestamp('ev_send_time'); // 이메일 전송 시각
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_verifieds');
    }
};
