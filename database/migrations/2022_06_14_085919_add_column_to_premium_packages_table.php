<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPremiumPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('premium_packages', function (Blueprint $table) {
            $table->decimal('price')->nullable()->after('title');
            $table->integer('duration')->nullable()->after('title');
            $table->text('description')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('premium_packages', function (Blueprint $table) {

        });
    }
}
