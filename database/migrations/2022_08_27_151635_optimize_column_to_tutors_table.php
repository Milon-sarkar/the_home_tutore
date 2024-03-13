<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OptimizeColumnToTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->string('year_of_study')->nullable()->after('session');
            $table->string('hall')->nullable()->after('institution');
            $table->string('student_id_card')->nullable()->after('institution');
            $table->integer('academic_information_percentage')->nullable()->default(0)->after('updated_at');
            $table->integer('academic_qualification_percentage')->nullable()->default(0)->after('updated_at');
            $table->integer('personal_information_percentage')->nullable()->default(0)->after('updated_at');
            $table->integer('interested_requirement_percentage')->nullable()->default(0)->after('updated_at');
            $table->integer('experience_tuition_percentage')->nullable()->default(0)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutors', function (Blueprint $table) {
            //
        });
    }
}
