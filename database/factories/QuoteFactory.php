<?php

namespace Database\Factories;

use App\Models\Quote;
use App\Models\Showcase;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'visible' => true,
            'body' => $this->faker->paragraph(5),
            'by' => $this->faker->name(),
            'job_title' => $this->faker->jobTitle(),
            'image_person' => $this->faker->image(),
        ];
    }
}
