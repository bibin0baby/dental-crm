<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsulations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->integer('doctor_id')->index();
            $table->integer('contact_id')->nullable()->index();
            $table->string('chiefcomplaint');
            $table->string('medicalhistory')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('prescription')->nullable();
            $table->string('otherdetails', 100)->nullable();
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
        Schema::dropIfExists('consulations');
    }
}
