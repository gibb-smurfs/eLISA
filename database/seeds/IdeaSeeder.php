<?php

use Illuminate\Database\Seeder;
use App\Models\Idea;

class IdeaSeeder extends Seeder
{
    public function run()
    {
        factory(Idea::class, 100)->create();
    }
}
