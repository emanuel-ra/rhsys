<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('genre');
            $table->string('curp');
            $table->string('rfc');
            $table->string('nss');
            $table->string('email');

            $table->string('nationality');

            $table->string('marital_status');

            $table->string('phone');
            $table->string('mobile_phone');
            $table->string('socioeconomic');            
            
            //$table->tinyInteger('enable')->default(1);

            $table->unsignedSmallInteger('company_id')->default(0);
            $table->unsignedSmallInteger('branch_id')->default(0);            
            $table->unsignedSmallInteger('jop_position_id')->default(0);
            $table->unsignedSmallInteger('department_id')->default(0);
            $table->unsignedSmallInteger('scholarship_id')->default(0);

            $table->datetime('hired_date')->nullable();
            $table->datetime('born_date')->nullable();
            $table->datetime('discharge_date')->nullable();
            $table->datetime('expiration_date')->nullable();

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
        Schema::dropIfExists('staff');
    }
}
