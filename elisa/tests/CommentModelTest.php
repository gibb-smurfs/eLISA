<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Providers\TripcodeProvider;
use App\Models\Comment;

class CommentModelTest extends TestCase
{
    /**
     * Testing the Idea saving Process and test for correctnes
     *
     * @return void
     */
    public function testCommentSaving()
    {
        $commentCreated = new Comment();
        $commentCreated->idea_id = 1;
        $commentCreated->name = TripcodeProvider::crypt('testuser');
        $commentCreated->title = 'testtitle';
        $commentCreated->content = 'testcontent';
        $commentCreated->save();

        $commentFound = Comment::find($commentCreated->id);

        $this->assertEquals(
            $commentCreated->name, $commentFound->name
        );
        $this->assertEquals(
            $commentCreated->title, $commentFound->title
        );
        $this->assertEquals(
            $commentCreated->content, $commentFound->content
        );
    }
}
