<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_availability', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->index()->nullable();
            $table->date('break_Fromtime', 25);
            $table->date('break_Totime', 25);
            $table->date('leave_FromDate', 25);
            $table->date('leave_ToDate', 25);
            $table->string('availabilityDays', 25);
            $table->date('availabilityFrom', 25);
            $table->date('availabilityTo', 25);            
            $table->string('consultation', 25);
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
        Schema::dropIfExists('doctor_availability');
    }
}
