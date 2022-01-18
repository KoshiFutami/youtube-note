<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Tag;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        Note::factory(30)->create()
            ->each(function (Note $note) use ($tags) {
                $random_num = rand(1, 3);

                $note->tags()->attach(
                    $tags->random($random_num)->pluck('id')->toArray()
                );
            });
    }
}
