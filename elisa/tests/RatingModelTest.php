<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Providers\TripcodeProvider;
use App\Models\Rating;

class RatingModelTest extends TestCase
{
    /**
     * Testing the Idea saving Process and test for correctnes
     *
     * @return void
     */
    public function testRatingSaving()
    {
        $ratingCreated = new Rating();
        $ratingCreated->idea_id = 1;
        $ratingCreated->rating = 3;
        $ratingCreated->save();

        $ratingFound = Rating::find($ratingCreated->id);

        $this->assertEquals(
            $ratingCreated->rating, $ratingFound->rating
        );
    }
}
