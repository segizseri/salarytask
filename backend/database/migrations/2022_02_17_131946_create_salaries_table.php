<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('salary')->nullable();
            $table->string('iit')->nullable();
            $table->string('cps')->nullable();
            $table->string('ccshi')->nullable();
            $table->string('cshi')->nullable();
            $table->string('ssc')->nullable();
            $table->string('salaryInHand')->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
