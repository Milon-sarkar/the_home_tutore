<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonalInformationToTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->string('father_number')->nullable()->after('father_name');
            $table->string('mother_number')->nullable()->after('mother_name');
            $table->string('parent_address')->nullable()->after('gender');
            $table->integer('parent_upazila_id')->nullable()->after('gender');
            $table->integer('parent_district_id')->nullable()->after('gender');
            $table->integer('parent_division_id')->nullable()->after('gender');
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
