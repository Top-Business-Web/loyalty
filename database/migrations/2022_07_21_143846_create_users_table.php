<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('phone_code',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('location',255)->nullable();
            $table->string('password',255);
            $table->integer('role_id')->comment('1 => provider, 2 => client')->default(2);
            $table->integer('status')->comment('0 => un active, 1 => active')->default(1);
            $table->string('image',255)->nullable();
            $table->double('balance')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
