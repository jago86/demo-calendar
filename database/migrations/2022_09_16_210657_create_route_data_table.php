<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId("route_id");
            $table->foreignId("calendar_id");
            $table->string("vinculation_route")->nullable();
            $table->boolean("route_circular");
            $table->dateTime("date_init");
            $table->dateTime("date_finish");
            $table->boolean("mon");
            $table->boolean("tue");
            $table->boolean("wed");
            $table->boolean("thu");
            $table->boolean("fri");
            $table->boolean("sat");
            $table->boolean("sun");
            $table->timestamps();

            $table->foreign('route_id')
            ->references('id')
                ->on('routes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('route_data');
    }
}
