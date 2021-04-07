<?php

namespace Database\Seeders;

use Epigra\TrGeoZones\Database\Seeders\GeozoneCountriesTableSeeder;
use Epigra\TrGeoZones\Database\Seeders\TrGeoZonesDatabaseSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('statuses')->truncate();
        DB::table('customer_types')->truncate();
        DB::table('size_codes')->truncate();
        DB::table('users')->truncate();
        DB::table('mods')->truncate();
        DB::table('companies')->truncate();
        DB::table('people')->truncate();
        DB::table('geozone_countries')->truncate();
        DB::table('geozone_cities')->truncate();
        DB::table('geozone_city_districts')->truncate();

        Schema::enableForeignKeyConstraints();



        $this->call(TrGeoZonesDatabaseSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(ModTableSeeder::class);
        $this->call(CustomerTypeTableSeeder::class);
        $this->call(SizeCodeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(NoteTableSeeder::class);
    }
}
