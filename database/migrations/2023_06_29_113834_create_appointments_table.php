<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->integer('doctor_id')->nullable()->index();
            $table->integer('contact_id')->nullable()->index();
            $table->string('title');
            $table->string('description');
            $table->dateTime('scheduled_at', $precision = 0);
            $table->integer('duration');
            $table->string('photo_path', 100)->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
