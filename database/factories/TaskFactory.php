<?php

namespace Database\Factories;

use App\Models\Project;
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
    public function definition()
    {
        $project_ids = Project::pluck('id')->toArray();
        return [
            'project_id' => $this->faker->randomElement($project_ids),
            'task_name' => $this->faker->sentence,
            'task_hours' => $this->faker->randomNumber(2),
        ];
    }
}
