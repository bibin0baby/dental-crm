<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilityName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilitys', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->integer('organization_id')->nullable()->index();
            $table->integer('doctor_id')->nullable(); 
            $table->string('break_Fromtime', 100)->nullable(); 
            $table->string('break_Totime', 100)->nullable();  
            $table->string('leave_FromDate', 100)->nullable(); 
            $table->string('leave_ToDate', 100)->nullable(); 
            $table->string('availabilityDays', 100)->nullable(); 
            $table->string('availabilityFrom', 100)->nullable(); 
            $table->string('availabilityTo', 100)->nullable(); 
            $table->string('ConsultaionTime', 100)->nullable(); 
            // $table->integer('doctor_id')->index()->nullable(); 
            // $table->string('break_Day', 25);
            // $table->date('break_Fromtime')->default('h:i A');
            // $table->date('break_Totime')->default('h:i A');
            // $table->date('leave_FromDate')->default('DD-MM-YYYY');
            // $table->date('leave_ToDate')->default('DD-MM-YYYY');
            // $table->string('availabilityDays', 25);
            // $table->date('availabilityFrom')->default('h:i A');
            // $table->date('availabilityTo')->default('h:i A');            
            // $table->string('consultation', 25);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilitys');
    }
}
