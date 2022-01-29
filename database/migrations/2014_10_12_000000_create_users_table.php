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
            $table->tinyText('name');
            $table->tinyText('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyText('middlename')->nullable();
            $table->tinyText('lastname')->nullable();
            $table->tinyText('phonenumber')->nullable();
            $table->tinyText('picture_url')->nullable();
            $table->boolean('Is_disabled')->default(false)->nullable();
            $table->tinyText('password');
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
