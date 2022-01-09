<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words($nb = 5, $asText = true),
            'content' => $this->faker->text($maxNbChars = 200),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'video_id' => function () {
                return Video::factory()->create()->id;
            },
        ];
    }
}
