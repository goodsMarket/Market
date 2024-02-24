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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('writer_id');
            $table->unsignedinteger('c_id');
            $table->string('p_title', 150);
            $table->timestamp('p_start_date');
            $table->timestamp('p_end_date');
            $table->unsignedInteger('p_schedule'); // 배송예정일
            $table->string('p_content', 9000);
            $table->char('p_age_limit', 1);
            $table->string('p_password', 50)->nullable();
            $table->string('p_thumbnail', 500);
            $table->char('p_notice_agreement',1);
            $table->char('p_twitter', 1)->nullable();
            $table->char('p_instagram', 1)->nullable();
            $table->string('p_question', 255)->nullable();
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
        Schema::dropIfExists('productions');
    }
};
