<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run()
    {
        factory(Rating::class, 1000)->create();
    }
}
