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
        Schema::create('used_trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('writer_id'); // 작성자 pk
            $table->unsignedBigInteger('c_id'); // 카테고리 pk
            $table->string('ut_title', 150); // 제목
            $table->string('ut_thumbnail', 500)->nullable(); // 썸네일
            $table->unsignedInteger('ut_price'); // 가격
            $table->unsignedInteger('ut_count')->default(1); // 개수
            $table->char('ut_quality',1); // 품질
            $table->unsignedBigInteger('sa_id')->nullable(); // 주소
            $table->string('ut_description', 3000); // 설명
            $table->char('ut_refund',1)->default('0'); // 환불
            $table->unsignedInteger('ut_view');
            $table->unsignedInteger('ut_like');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('used_trades');
    }
};
