<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_address')->nullable();
            $table->unsignedBigInteger('company_main_country')->nullable();
            $table->unsignedBigInteger('company_country')->nullable();
            $table->unsignedBigInteger('company_city')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_author')->nullable();
            $table->string('company_web_site')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('sector')->nullable();
            $table->string('field')->nullable();
            $table->string('potential_fleet')->nullable();
            $table->string('is_active');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('customer_type_id');
            $table->unsignedBigInteger('size_code_id');
            $table->foreign('company_main_country')->references('id')->on('geozone_countries')->onDelete('cascade');
            $table->foreign('company_country')->references('id')->on('geozone_countries')->onDelete('cascade');
            $table->foreign('company_city')->references('id')->on('geozone_cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('customer_type_id')->references('id')->on('customer_types')->onDelete('cascade');
            $table->foreign('size_code_id')->references('id')->on('size_codes')->onDelete('cascade');
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
        Schema::dropIfExists('companies');
    }
}
