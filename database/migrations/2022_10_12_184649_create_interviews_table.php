<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('commentaries',500)->nullable();
            $table->string('observations',500)->nullable();
            $table->unsignedSmallInteger('candidate_id')->default(0);
            $table->unsignedSmallInteger('status_id')->default(1);
            $table->unsignedSmallInteger('type_interview_id')->default(1);
            $table->unsignedSmallInteger('user_id')->default(1);
            $table->tinyInteger('attendance')->default(0);
            $table->datetime('interview_date');
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
        Schema::dropIfExists('interviews');
    }
}
