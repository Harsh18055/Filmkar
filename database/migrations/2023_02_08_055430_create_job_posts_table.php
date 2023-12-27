<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('representers_id');
            $table->integer('job_role_id');
            $table->enum('gender', ['male', 'female']);
            $table->integer('MinAge');
            $table->integer('MaxAge');
            $table->enum('audition_required', ['yes', 'no']);
            $table->integer('budget');
            $table->enum('budget_duration', ['per day', 'per week', 'per month']);
            $table->date('last_date');
            $table->date('job_start');
            $table->date('job_end');
            $table->integer('No_of_vacancies');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('tags');
            $table->integer('status');
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
        Schema::dropIfExists('job_posts');
    }
}
