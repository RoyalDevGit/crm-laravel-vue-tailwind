<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('person_first_name');
            $table->string('person_last_name');
            $table->string('person_gender');
            $table->string('person_department');
            $table->string('person_email');
            $table->string('person_phone');
            $table->string('person_phone2');
            $table->string('person_preferred ');
            $table->unsignedBigInteger('companies_id');
            $table->unsignedBigInteger('user_id');
            $table->string('is_active');
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('people');
    }
}
