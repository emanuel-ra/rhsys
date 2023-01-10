<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('staff_id')->default(0);   
            $table->unsignedInteger('user_id')->default(0);
            $table->string('description');         
            $table->json('data')->nullable();   
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
        Schema::dropIfExists('staff_logs');
    }
}
