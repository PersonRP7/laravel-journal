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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // Fk
            // previous
            // $table->integer('user_id')->unsigned()->nullable();
            // previous
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Fk

            // title
            $table->string('title')->nullable();
            // title

            // text
            $table->string('text')->nullable();
            // text

            // image name
            $table->string('name');
            // image name

            // image path
            $table->string('path');
            // image path



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
        Schema::dropIfExists('posts');
    }
};
