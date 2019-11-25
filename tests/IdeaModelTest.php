<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Providers\TripcodeProvider;
use App\Models\Idea;

class IdeaModelTest extends TestCase
{
    /**
     * Testing the Idea saving Process and test for correctnes
     *
     * @return void
     */
    public function testIdeaSaving()
    {
        //$ideaAltCreate = Idea::create(['name' => TripcodeProvider::crypt('testuser'), 'email' => 'testuser@email.com', 'title' => 'testtitle', 'content' => 'testcontent']);

        $ideaCreated = new Idea();
        $ideaCreated->name = TripcodeProvider::crypt('testuser');
        $ideaCreated->email = 'testuser@email.com';
        $ideaCreated->title = 'testtitle';
        $ideaCreated->content = 'testcontent';
        $ideaCreated->save();

        $ideaFound = Idea::find($ideaCreated->id);

        $this->assertEquals(
            $ideaCreated->name, $ideaFound->name
        );
        $this->assertEquals(
            $ideaCreated->email, $ideaFound->email
        );
        $this->assertEquals(
            $ideaCreated->title, $ideaFound->title
        );
        $this->assertEquals(
            $ideaCreated->content, $ideaFound->content
        );
    }
}
