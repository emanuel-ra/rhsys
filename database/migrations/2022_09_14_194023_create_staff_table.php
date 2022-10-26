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
            $table->string('code',20);
            $table->string('checker_code',20)->nullable();
            $table->string('genre',20)->nullable();
            $table->string('curp',20)->nullable();
            $table->string('rfc',20)->nullable();
            $table->string('nss',20)->nullable();
            $table->string('email')->nullable();                                    
            $table->string('mobile_phone')->nullable();     
            $table->string('landline_number')->nullable();         
            $table->string('landline_emergency_phone')->nullable();
            $table->string('mobile_emergency_phone')->nullable();
            $table->string('address')->nullable();      
            $table->string('suburb')->nullable();      
            $table->string('zip_code')->nullable();      
            $table->string('town')->nullable();      
            $table->string('city')->nullable();      
            $table->string('bank_account')->nullable();
            $table->string('reason_unsubscribe_text')->nullable();
            $table->string('activities',550)->nullable();
            $table->string('blood_type',20)->nullable();
            $table->string('blood_place',20)->nullable();
            
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('chields_name',500)->nullable();

            $table->unsignedSmallInteger('company_id')->default(0);
            $table->unsignedSmallInteger('branch_id')->default(0);            
            $table->unsignedSmallInteger('jop_position_id')->default(0);
            $table->unsignedSmallInteger('department_id')->default(0);
            $table->unsignedSmallInteger('scholarship_id')->default(0);
            $table->unsignedSmallInteger('maritial_status_id')->default(0);
            $table->unsignedSmallInteger('user_id')->default(0);
            $table->unsignedSmallInteger('reason_unsubscribe_id')->default(0);            
            
            $table->unsignedSmallInteger('country_id')->default(0);
            $table->unsignedSmallInteger('state_id')->nullable();
            $table->unsignedSmallInteger('status_id')->default(4);
            $table->unsignedSmallInteger('supervisor_id')->default(0);
            $table->unsignedSmallInteger('type_of_contract_id')->default(0);
            
            $table->unsignedSmallInteger('socioeconomic')->default(0);
            $table->unsignedSmallInteger('supervisor')->default(0);
            
            $table->date('hired_date')->nullable();
            $table->date('born_date')->nullable();
            $table->date('unsubscribe_date')->nullable();
            $table->date('expiration_date')->nullable();

            $table->json('working_hours')->nullable();
            $table->decimal('daily_salary', 15 , 2)->default(0);
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
