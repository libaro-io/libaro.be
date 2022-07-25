<?php

namespace Database\Factories;

use App\Models\Key;
use App\Models\Showcase;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Key::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'visible' => true,
            'number' => $this->faker->numberBetween(1, 99),
            'title' => implode(' ', $this->faker->words(2)),
            'body' => $this->faker->paragraph(6)
        ];
    }
}
