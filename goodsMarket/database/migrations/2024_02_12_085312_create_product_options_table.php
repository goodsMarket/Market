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
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('p_id'); // 굿즈제작 게시글 pk
            $table->string('po_title',100); // 상품제목
            $table->unsignedInteger('po_price'); // 상품가격
            $table->unsignedInteger('po_count'); // 상품개수
            $table->unsignedInteger('po_limit')->nullable(); // 구매개수제한
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
};
