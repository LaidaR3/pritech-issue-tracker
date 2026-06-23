<?php

namespace Database\Factories;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Issue>
 */
class IssueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => \App\Models\Project::factory(),
            'title' => fake()->randomElement([
                'Fix Login Bug',
                'Create Dashboard',
                'Update Landing Page',
                'Implement Search',
                'Improve Performance',
                'Add User Roles',
                'Fix Mobile Layout'
            ]),
            'description' => fake()->randomElement([
                'Users cannot log in.',
                'Build a dashboard for administrators.',
                'Update homepage content and styling.',
                'Implement search functionality.',
                'Optimize database queries.',
                'Add role-based permissions.'
            ]),
            'status' => fake()->randomElement(['open', 'in_progress', 'closed']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'due_date' => fake()->date(),
        ];
    }
}
