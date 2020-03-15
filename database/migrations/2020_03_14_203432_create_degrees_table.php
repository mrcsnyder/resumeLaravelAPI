<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('education_id')->nullable();
            $table->string('degree_or_certificate');
            $table->string('major');
            $table->longText('honors_info');
            $table->string('gpa')->nullable();
            $table->string('completed_month_year_preformat')->nullable();
            $table->string('completed_month_year_format')->nullable();
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
        Schema::dropIfExists('degrees');
    }
}
