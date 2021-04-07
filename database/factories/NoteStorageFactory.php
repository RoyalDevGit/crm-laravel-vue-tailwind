<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Note;
use App\Models\NoteStorage;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteStorageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NoteStorage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note_id' => Note::all()->random()->id,
            'storage_id' => Storage::all()->random()->id,
        ];
    }
}
