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
        Schema::create('order_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_id'); // 굿즈주문내역 pk
            $table->unsignedBigInteger('po_id'); // 상품 옵션 pk
            $table->unsignedInteger('oo_order_count'); // 구매개수
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_options');
    }
};
