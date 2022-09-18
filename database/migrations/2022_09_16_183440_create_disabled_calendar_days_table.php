<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisabledCalendarDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disabled_calendar_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendar_id');
            $table->dateTime('day');
            $table->boolean('enabled');
            $table->timestamps();

            $table->foreign('calendar_id')
                ->references('id')
                ->on('calendars')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disabled_calendar_days');
    }
}
