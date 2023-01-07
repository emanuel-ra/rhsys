<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();                                    
            $table->string('mobile_phone')->nullable();   
            $table->unsignedSmallInteger('requisition_id')->default(0);
            $table->unsignedSmallInteger('sources_id')->default(0);         
            $table->unsignedSmallInteger('status_id')->default(1);
            $table->unsignedSmallInteger('user_id')->default(0);            
            $table->string('commentaries',500)->nullable();
            $table->tinyInteger('is_hired')->default(0);
            $table->tinyInteger('is_accepted')->default(0);
            $table->date('hired_date')->nullable();
            $table->date('accepted_date')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
