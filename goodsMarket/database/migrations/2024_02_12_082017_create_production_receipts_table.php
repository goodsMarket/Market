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
        Schema::create('production_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('p_id');
            $table->unsignedBigInteger('consumer_id');
            $table->unsignedBigInteger('sw_id');
            $table->unsignedBigInteger('ba_id');
            $table->unsignedInteger('pr_order_number');
            $table->string('twitter_id', 90);
            $table->string('instagram_id', 90);
            $table->char('pr_order_status', 1)->default('0');
            $table->string('pr_answer', 255);
            $table->string('pr_compony', 30);
            $table->string('pr_number', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('pr_refund_request');
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
        Schema::dropIfExists('production_receipts');
    }
};
