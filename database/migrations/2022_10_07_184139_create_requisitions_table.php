<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('company_id')->default(0);
            $table->unsignedSmallInteger('branch_id')->default(0);
            $table->unsignedSmallInteger('jop_position_id')->default(0);
            $table->unsignedSmallInteger('department_id')->default(0);
            $table->unsignedSmallInteger('user_id')->default(0);
            $table->unsignedSmallInteger('cancelation_user_id')->default(0);
            $table->unsignedSmallInteger('supervisor_id')->default(0);
            $table->unsignedSmallInteger('status_id')->default(1);

            $table->unsignedSmallInteger('request_quantity')->default(1);
            $table->unsignedSmallInteger('hired_quantity')->default(0);

            $table->date('request_date')->nullable();
            $table->date('closed_date')->nullable();
            $table->date('cancel_date')->nullable();

            $table->string('commentaries',500)->nullable();            
            $table->string('cancelation_reason',500)->nullable();            
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
        Schema::dropIfExists('requisitions');
    }
}
