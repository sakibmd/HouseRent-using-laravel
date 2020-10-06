<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('entry');
            $table->string('leave')->nullable();
            $table->integer('landlord_id');
            $table->integer('renter_id');
            $table->string('landlord_name');
            $table->string('renter_name');
            $table->string('landlord_email');
            $table->string('renter_email');
            $table->string('landlord_contact');
            $table->string('renter_contact');
            $table->string('booking_status')->default('notBooked');
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
        Schema::dropIfExists('booings');
    }
}
