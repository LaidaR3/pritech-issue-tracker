<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Website Redesign',
                'Mobile App',
                'Customer Portal',
                'Issue Tracker',
                'Admin Dashboard'
            ]),
            'description' => fake()->randomElement([
                'Improve user experience',
                'Fix bugs and add features',
                'Modernize the application',
                'Build new functionality'
            ]),
            'start_date' => fake()->date(),
            'deadline' => fake()->date(),
        ];
    }
}
