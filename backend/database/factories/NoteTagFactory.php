<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $note_ids = Note::pluck('id')->all();
        $tag_ids = Tag::pluck('id')->all();

        return [
            'note_id' => array_rand($note_ids),
            'tag_id' => array_rand($tag_ids),
        ];
    }
}
