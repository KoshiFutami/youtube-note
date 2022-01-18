<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoteTag;

class NoteTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NoteTag::factory(20)->create();
    }
}
