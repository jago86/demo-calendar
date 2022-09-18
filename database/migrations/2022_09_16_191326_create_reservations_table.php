<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_plan_id");
            $table->foreignId("route_id");
            $table->string("track_id")->nullable();
            $table->dateTime("reservation_start");
            $table->dateTime("reservation_end");
            $table->foreignId("route_stop_origin_id");
            $table->foreignId("route_stop_destination_id");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_plan_id')
                ->references('id')
                ->on('user_plans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('route_id')
            ->references('id')
                ->on('routes')
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
        Schema::dropIfExists('reservations');
    }
}
