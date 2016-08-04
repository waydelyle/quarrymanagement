<?php

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
            $table->string('surname');
            $table->string('email')->unique();
            $table->boolean('admin');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('oil_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('label');
        });

        Schema::create('oil', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('amount');
            $table->integer('oil_type_id')->references('id')->on('oil_types');
            $table->integer('vehicle_id')->references('id')->on('vehicles');
            $table->integer('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('diesel', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('meter');
            $table->bigInteger('amount');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('vehicle_id')->references('id')->on('vehicles');;
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registration')->unique();
            $table->integer('user_id')->references('id')->on('users');
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
        Schema::drop('users');
    }
}
