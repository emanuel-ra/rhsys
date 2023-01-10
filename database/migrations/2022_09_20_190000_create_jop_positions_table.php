<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJopPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jop_positions', function (Blueprint $table) {
            $table->id();            
            $table->string('name');
            $table->tinyInteger('enable')->default(1);
            $table->unsignedInteger('department_id')->default(0);
            $table->string('activities',550)->nullable();
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
        Schema::dropIfExists('jop_positions');
    }
}
