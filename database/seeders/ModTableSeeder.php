<?php

namespace Database\Seeders;

use App\Models\Mod;
use Illuminate\Database\Seeder;

class ModTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            'Receptive',
            'Dissatisfaction',
            'Power',
        ];

        foreach ($type as $item){
            Mod::create([
                'name' => $item,
                'description' => 'Lorem Ipsum, masaüstü yayıncılık ve basın yayın sektöründe kullanılan taklit yazı bloğu olarak tanımlanır.',
            ]);
        }
    }
}
