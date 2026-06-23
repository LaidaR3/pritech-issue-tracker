<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'issue_id' => \App\Models\Issue::factory(),
            'author_name' => fake()->randomElement([
                'John Smith',
                'Emma Wilson',
                'Michael Brown',
                'Sarah Johnson',
                'David Miller'
            ]),
            'body' => fake()->randomElement([
                'This issue needs attention.',
                'I can reproduce this bug.',
                'The fix has been tested.',
                'Looks good to me.',
                'Please review the implementation.',
                'Additional testing is required.'
            ]),
        ];
    }
}
