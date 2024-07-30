<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture');
            $table->string('full_name');
            $table->integer('age');
            $table->date('birth');
            $table->integer('phone')->nullable();
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('status');
            $table->string('work');
            $table->string('type');
            $table->string('address');
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
        Schema::dropIfExists('employee');
    }
}