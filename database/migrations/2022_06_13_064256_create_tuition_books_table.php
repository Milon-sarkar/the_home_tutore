<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuitionBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuition_books', function (Blueprint $table) {
            $table->id();
            $table->integer('tutor_id')->nullable();
            $table->integer('tuition_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('status')->nullable()->comment('0=pending,1=booking, 2=applied, 3=rejected');
            $table->double('salary', 20, 2)->default(0)->comment(' 0 = Free, otherwise show');
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('tuition_books');
    }
}
