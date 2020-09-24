<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedSmallInteger('type');
            $table->string('title');
            $table->text('value');
            $table->string('image')->nullable();
            $table->unsignedInteger('order');
            $table->unsignedInteger('time_limit')->nullable();
            $table->timestamps();

            $table->foreign('section_id')
                ->references('id')->on('sections')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('questions');
    }
}
