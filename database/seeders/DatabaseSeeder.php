<?php

namespace Database\Seeders;

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
        DB::table('users')->truncate();
        DB::table('companies')->truncate();
        DB::table('people')->truncate();
        Schema::enableForeignKeyConstraints();

        $this->call(UserTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(PersonTableSeeder::class);
    }
}
