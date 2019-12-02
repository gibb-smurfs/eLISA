<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialMigration extends Migration
{
    public function up()
    {
        Schema::create('t_idea', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32);
            $table->string('email', 512);
            $table->string('title', 80);
            $table->string('content', 1000);
            $table->timestamps();
        });

        Schema::create('t_rating', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idea_id');
            $table->tinyInteger('rating');
            $table->timestamps();

            $table->foreign('idea_id')->references('id')->on('t_idea');
        });

        Schema::create('t_comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idea_id');
            $table->string('name', 80);
            $table->string('title', 80);
            $table->string('content', 1000);
            $table->timestamps();

            $table->foreign('idea_id')->references('id')->on('t_idea');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rating');
        Schema::dropIfExists('t_comment');
        Schema::dropIfExists('t_idea');
    }
}
