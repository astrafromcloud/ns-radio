<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Broadcaster>
 */
class BroadcasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image_path' => $this->faker->imageUrl(),
            'bio' => $this->faker->text(),
            'instagram_url' => $this->faker->url(),
            'youtube_url' => $this->faker->url(),
            'whatsapp_url' => $this->faker->url(),
            'telegram_url' => $this->faker->url(),
        ];
    }
}
