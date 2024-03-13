<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomecolumnsToTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->string('faculty')->nullable()->after('hons_subject');
            $table->string('hsc_institute')->nullable()->after('hons_marksheet');
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
