<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'success',
            'pending',
            'not accepted',
            'no response',
        ];

        foreach ($status as $item){
            Status::create([
                'name' => $item,
                'description' => 'Lorem Ipsum, masaüstü yayıncılık ve basın yayın sektöründe kullanılan taklit yazı bloğu olarak tanımlanır.',
            ]);
        }
    }
}
