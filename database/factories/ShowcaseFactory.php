<?php

namespace Database\Factories;

use App\Models\Showcase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowcaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Showcase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images_card = ['ghelamco_showcase.png', 'antwerp_showcase.png', 'zoute_showcase.png', 'skylux_showcase.png'];
        $images_logo = ['skylux.png', 'dekeyzer.png', 'kom_op_tegen_kanker.png', 'meet_district.png', 'ghelamco.png'];

        return [
            'visible' => true,
            'name' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'type' => 'Website',
            'what' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'info_1' => implode(' ', $this->faker->words(4)),
            'info_2' => implode(' ', $this->faker->words(4)),
            'image_card' => $images_card[array_rand($images_card)],
            'image_header' => $images_card[array_rand($images_card)],
            'image_extra' => $images_card[array_rand($images_card)],
            'image_logo' => $images_logo[array_rand($images_logo)],
            'client_url' => $this->faker->url(),
        ];
    }
}
