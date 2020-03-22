<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role');
            $table->string('company_name')->nullable();
            $table->longText('description');

            $table->string('start_date_month_year_preformat')->nullable();
            $table->string('start_date_month_year_format')->nullable();

            $table->string('end_date_month_year_preformat')->nullable();
            $table->string('end_date_month_year_format')->nullable();

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
        Schema::dropIfExists('work');
    }
}
