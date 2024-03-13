<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuitions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->string('job_id')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->text('address')->nullable();
            $table->string('duration')->nullable();
            $table->string('phone')->nullable();
            $table->longtext('tclass')->nullable();
            $table->string('institution')->nullable();
            $table->longtext('subject_ids')->nullable();
            $table->string('requirement')->nullable();
            $table->string('class_type')->nullable()->comment('physical or Online');
            $table->string('student_number')->nullable();
            $table->longtext('gender')->nullable();
            $table->longtext('interest_sub')->nullable();
            $table->longtext('interest_class')->nullable();
            $table->longtext('interest_medium')->nullable();
            $table->longtext('student_medium')->nullable();
            $table->longtext('interest_gender')->nullable();
            $table->longtext('interest_time')->nullable();
            $table->longtext('interest_institution')->nullable();
            $table->longtext('weekly')->nullable();
            $table->integer('salary_show_hide')->default(0)->comment(' 0 = Nagotiable 1=show')->nullable();
            $table->double('salary', 20, 2)->default(0)->comment(' 0 = Nagotiable otherwise show')->nullable();
            $table->integer('status')->default(0)->comment(' 0 = Inactive,1=active,2=booked')->nullable();
            $table->text('details')->nullable();
            $table->string('hiring_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('already_user')->default(0)->comment(' 0 = No,1=Yes')->nullable();
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
        Schema::dropIfExists('tuitions');
    }
}
