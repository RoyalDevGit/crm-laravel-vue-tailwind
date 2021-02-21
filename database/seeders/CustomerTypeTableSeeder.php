<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Seeder;

class CustomerTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            'prospect',
            'target',
            'current',
            'internal',
            'external',
            'new',
            'old',
        ];

        foreach ($type as $item){
            CustomerType::create([
                'name' => $item,
                'description' => 'Lorem Ipsum, masaüstü yayıncılık ve basın yayın sektöründe kullanılan taklit yazı bloğu olarak tanımlanır.',
            ]);
        }
    }
}
