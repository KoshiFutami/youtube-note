<?php

namespace Database\Factories;

use App\Models\User;
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
            'yt_video_id' => $this->faker->randomElement($array = array('vVaFIMul_08', 'nwEWuaIpdOo', 'CGq4-rqnBgs', 'a37VfzdDswE', 'IblUogq9gOw', 'NL0YRlVZ9Rc', 'ye3n5_tr8vg')),
            'start_seconds' => $this->faker->randomElement($array = array(30, 60, 90, 120, 150)),
        ];
    }
}
