<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->string('session')->nullable()->after('institution');
            $table->string('ssc_year')->nullable()->after('facebook_link');
            $table->string('ssc_result')->nullable()->after('facebook_link');
            $table->string('ssc_group')->nullable()->after('facebook_link');
            $table->string('hsc_year')->nullable()->after('facebook_link');
            $table->string('hsc_result')->nullable()->after('facebook_link');
            $table->string('hsc_group')->nullable()->after('facebook_link');
            $table->string('hons_last_passed_year')->nullable()->after('facebook_link');
            $table->string('hons_last_passed_result')->nullable()->after('facebook_link');
            $table->string('hons_subject')->nullable()->after('facebook_link');
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
