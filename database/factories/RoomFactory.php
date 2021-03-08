<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $state = $this->faker->state;
        return [
            'name' => $state,
            'slug' => Str::of($state)->slug('-'),
            'active' => rand(0,50)
        ];
    }
}
