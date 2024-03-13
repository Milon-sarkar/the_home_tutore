<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns2ToTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->string('permanent_address')->nullable()->after('address');
            $table->integer('permanent_upazila_id')->nullable()->after('address');
            $table->integer('permanent_district_id')->nullable()->after('address');
            $table->integer('permanent_division_id')->nullable()->after('address');
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
