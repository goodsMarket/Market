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
        Schema::create('board_imgs', function (Blueprint $table) {
            $table->id();
            $table->char('bi_board_flg',1); // 게시글 flg
            $table->unsignedBigInteger('board_id'); // 굿즈제작 / 중고거래 / 문의 pk
            $table->string('bi_img_path',500); // 이미지 주소
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_imgs');
    }
};
