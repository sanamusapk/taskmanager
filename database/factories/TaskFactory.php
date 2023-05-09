<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Task::class;

    public function definition(): array
    {
        return  [
            'name' => $this->faker->sentence,
            'type' => $this->faker->numberBetween(1, 4),
            'day' => $this->faker->numberBetween(1, 30),
            'month' => $this->faker->numberBetween(1, 12),
            'nature' => $this->faker->numberBetween(1, 2),
            'iteration' =>$this->faker->numberBetween(1, 100),
            'start_date' => $this->faker->dateTimeBetween('-4 weeks', '+3 weeks'),
            'end_date' => $this->faker->dateTimeBetween('+3 weeks', '+7 weeks'),
            'description' => $this->faker->paragraph,
        ];
    }
}
