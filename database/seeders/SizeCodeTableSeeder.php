<?php

namespace Database\Seeders;

use App\Models\SizeCode;
use Illuminate\Database\Seeder;

class SizeCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = [
            'small',
            'medium',
            'large',
        ];
        foreach ($size as $item){
            SizeCode::create([
                'name' => $item,
                'description' => 'Lorem Ipsum, masaüstü yayıncılık ve basın yayın sektöründe kullanılan taklit yazı bloğu olarak tanımlanır.',
            ]);
        }
    }
}
