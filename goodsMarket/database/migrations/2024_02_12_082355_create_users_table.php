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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('k_id', 255)->nullable();
            $table->string('n_id', 255)->nullable();
            $table->string('u_name', 150);
            $table->string('u_nickname', 150);
            $table->string('u_back_img', 50);
            $table->string('u_email', 150);
            $table->string('u_pw', 50);
            $table->string('u_profile_img', 255);
            $table->string('u_access_token', 255)->nullable();
            $table->char('u_phone_num', 255);
            $table->string('u_pccc', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->char('u_agree_flg', 1);
            $table->timestamp('u_adult_flg')->nullable();
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
        Schema::dropIfExists('users');
    }
};
