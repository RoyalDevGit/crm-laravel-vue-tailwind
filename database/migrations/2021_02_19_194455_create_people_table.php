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
            $table->string('person_title')->nullable();
            $table->string('person_department')->nullable();
            $table->string('person_email');
            $table->string('person_phone')->nullable();
            $table->string('person_phone2')->nullable();
            $table->string('preferred_contact')->nullable();
            $table->string('skype')->nullable();
            $table->string('social_media')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('companies_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('mod_id');
            $table->unsignedBigInteger('person_countries')->nullable();
            $table->unsignedBigInteger('person_cities')->nullable();
            $table->unsignedBigInteger('person_district')->nullable();
            $table->string('is_active');
            $table->foreign('person_countries')->references('id')->on('geozone_countries')->onDelete('cascade');
            $table->foreign('person_cities')->references('id')->on('geozone_cities')->onDelete('cascade');
            $table->foreign('person_district')->references('id')->on('geozone_city_districts')->onDelete('cascade');
            $table->foreign('mod_id')->references('id')->on('mods')->onDelete('cascade');
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
