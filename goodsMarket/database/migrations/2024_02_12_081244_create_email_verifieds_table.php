<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_verifieds', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // 이메일
            $table->char('ev_token', 6); // 인증번호
            $table->timestamp('ev_send_time')->useCurrent(); // 이메일 전송 시각
            // $table->timestamp('ev_verified')->useCurrent(); // 이메일 인증 시각
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
