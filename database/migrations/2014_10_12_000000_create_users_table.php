<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->dateTime('date_of_birth');
            $table->string('address');
            $table->tinyInteger('gender')->comment('0 - nu, 1 - nam');
            $table->char('phone',30);
            $table->char('email',100)->unique();
            $table->string('password');
            $table->string('login_name');
            $table->string('avarta');
            $table->tinyInteger('status');
            $table->rememberToken();
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
}
