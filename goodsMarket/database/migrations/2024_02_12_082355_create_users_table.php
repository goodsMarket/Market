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
            $table->string('u_nickname', 150)->unique();
            $table->string('u_back_img', 50)->nullable();
            $table->string('u_email', 255)->unique();
            $table->string('u_pw', 255);
            $table->string('u_profile_img', 255)->nullable();
            $table->string('u_access_token', 255)->nullable();
            $table->string('u_phone_num', 20)->unique();
            $table->string('u_pccc', 50)->nullable();
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
