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
            $table->string('name_person_emergency')->nullable();
            $table->string('address')->nullable();      
            $table->string('suburb')->nullable();      
            $table->string('zip_code')->nullable();      
            $table->string('town')->nullable();      
            $table->string('city')->nullable();      
            $table->string('bank_account')->nullable();
            $table->string('reason_unsubscribe_text')->nullable();            
            $table->string('blood_type',20)->nullable();
            $table->string('born_place',20)->nullable();
            
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('chields_name',500)->nullable();

            $table->unsignedInteger('company_id')->default(0);
            $table->unsignedInteger('branch_id')->default(0);            
            $table->unsignedInteger('jop_position_id')->default(0);
            $table->unsignedInteger('department_id')->default(0);
            $table->unsignedInteger('scholarship_id')->default(0);
            $table->unsignedInteger('maritial_status_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('reason_unsubscribe_id')->default(0);            
            
            $table->unsignedInteger('country_id')->default(0);
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('status_id')->default(4);
            $table->unsignedInteger('supervisor_id')->default(0);
            $table->unsignedInteger('type_of_contract_id')->default(0);
            
            $table->unsignedInteger('socioeconomic')->default(0);
            $table->unsignedInteger('supervisor')->default(0);
            
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
