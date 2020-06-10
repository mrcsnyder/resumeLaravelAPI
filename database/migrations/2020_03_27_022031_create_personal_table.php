<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->unique();
            $table->string('name')->nullable();
            $table->string('current_role')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('resume')->nullable();
            $table->string('git_source')->nullable();
            $table->string('linkedin')->nullable();
            $table->longText('professional_intro')->nullable();
            $table->longText('hobbies_interests')->nullable();
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
        Schema::dropIfExists('personal');
    }
}
