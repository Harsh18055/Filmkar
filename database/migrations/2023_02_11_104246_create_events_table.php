<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('event_cat_id');
            $table->string('title');
            $table->string('thumbnail');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->date('date');
            $table->string('time');
            $table->integer('price');
            $table->longText('about_event');
            $table->longText('tags');
            $table->integer('status');
            $table->integer('is_approved');
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
        Schema::dropIfExists('events');
    }
}
