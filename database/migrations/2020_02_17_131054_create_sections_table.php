<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exam_id');
            $table->string('name', 200);
            $table->unsignedInteger('score_per_question');
            $table->unsignedInteger('passing_grade');
            $table->unsignedInteger('order');
            $table->text('instruction')->nullable();
            $table->unsignedInteger('time_limit')->nullable();
            $table->timestamps();

            $table->foreign('exam_id')
                ->references('id')->on('exams')
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
        Schema::dropIfExists('sections');
    }
}
