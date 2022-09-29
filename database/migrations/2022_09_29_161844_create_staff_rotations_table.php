<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffRotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_rotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('staff_id')->default(0);   
            $table->unsignedSmallInteger('supervisor_id')->default(0);
            $table->unsignedSmallInteger('company_id')->default(0);
            $table->unsignedSmallInteger('branch_id')->default(0);
            $table->unsignedSmallInteger('department_id')->default(0);
            $table->unsignedSmallInteger('jop_position_id')->default(0);
            $table->unsignedSmallInteger('scholarship_id')->default(0);
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
        Schema::dropIfExists('staff_rotations');
    }
}
