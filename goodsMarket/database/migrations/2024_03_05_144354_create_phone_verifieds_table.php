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
        Schema::create('phone_verifieds', function (Blueprint $table) {
            $table->id();
            $table->string('phone'); // 폰번호
            $table->char('pv_token', 6); // 인증번호
            $table->timestamp('pv_send_time')->useCurrent(); // 번호 전송 시각
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_verifieds');
    }
};
