<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        factory(Comment::class, 500)->create();
    }
}
