<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('option_id')->nullable();
            $table->unsignedSmallInteger('is_correct')->nullable();
            $table->unsignedBigInteger('score')->nullable();
            $table->timestamps();

            $table->foreign('participant_id')
                ->references('id')->on('participants')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('section_id')
                ->references('id')->on('sections')
                ->onDelete('cascade');

            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
