<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuarryStockManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->integer('job_type_id')->references('id')->on('job_types');
            $table->string('label');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('job_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->integer('id_number')->unique();
            $table->decimal('salary', 5, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empoyee_id')->references('id')->on('employees');
            $table->integer('stock_type_id')->references('id')->on('stock_types');
            $table->integer('job_type_id')->references('id')->on('jobs');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('stock_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('label');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('stock_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('label');
            $table->integer('count');
            $table->string('description');
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
        //
    }
}
