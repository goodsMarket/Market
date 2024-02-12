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
        Schema::create('used_trade_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('utr_order_number'); // 주문번호
            $table->unsignedBigInteger('ut_id'); // 중고거래글 pk
            $table->unsignedBigInteger('consumer_id'); // 주문자 pk
            $table->unsignedBigInteger('shipment_id')->nullable(); // 직거래/배송선택 pk
            $table->unsignedBigInteger('sa_id')->nullable(); // 배송지 pk
            $table->unsignedInteger('utr_price'); // 최종가격
            $table->unsignedInteger('utr_count'); // 개수
            $table->timestamp('created_at')->useCurrent(); // timestamp O, timestamps X
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('used_trade_receipts');
    }
};
