<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeline>
 */
class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $icons = ['fas fa-envelope', 'fas fa-bell', 'fas fa-calendar', 'fas fa-star'];
        $colors = ['bg-blue', 'bg-red', 'bg-green', 'bg-yellow'];

        return [
            'judul' => $this->faker->sentence(3),
            'konten' => $this->faker->optional()->paragraph(),
            'icon' => $this->faker->randomElement($icons),
            'color' => $this->faker->randomElement($colors),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
        ];
    }
}
