<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::factory(8)->create();

        Project::factory(5)
            ->has(
                Issue::factory(4)
                    ->has(Comment::factory(3))
            )
            ->create()
            ->each(function ($project) use ($tags) {
                foreach ($project->issues as $issue) {
                    $issue->tags()->attach(
                        $tags->random(rand(1, 3))->pluck('id')->toArray()
                    );
                }
            });
    }
}