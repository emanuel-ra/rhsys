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
            $table->unsignedInteger('staff_id')->default(0);   
            $table->unsignedInteger('supervisor_id')->default(0);
            $table->unsignedInteger('company_id')->default(0);
            $table->unsignedInteger('branch_id')->default(0);
            $table->unsignedInteger('department_id')->default(0);
            $table->unsignedInteger('jop_position_id')->default(0);
            $table->unsignedInteger('scholarship_id')->default(0);
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
