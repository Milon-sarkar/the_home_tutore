<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('tutor_code')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->text('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('institution')->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('gender')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->longtext('interest_sub')->nullable();
            $table->longtext('interest_class')->nullable();
            $table->longtext('interest_location')->nullable();
            $table->longtext('interest_medium')->nullable();
            $table->longtext('interest_gender')->nullable();
            $table->longtext('interest_time')->nullable();
            $table->longtext('weekly')->nullable();
            $table->string('member_type')->nullable();
            $table->string('salary_show_hide')->default(1);
            $table->double('salary', 20, 2)->default(0)->comment(' 0 = Nagotiable otherwise show');
            $table->integer('status')->default(0);
            $table->string('details')->nullable();
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
        Schema::dropIfExists('tutors');
    }
}
