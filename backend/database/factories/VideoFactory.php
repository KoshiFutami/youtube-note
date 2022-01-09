<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'yt_video_id' => $this->faker->randomElement($array = array('vVaFIMul_08', 'nwEWuaIpdOo', 'CGq4-rqnBgs', 'a37VfzdDswE', 'IblUogq9gOw')),
            'start_seconds' => $this->faker->randomElement($array = array(30, 60, 90, 120, 150)),
        ];
    }
}
