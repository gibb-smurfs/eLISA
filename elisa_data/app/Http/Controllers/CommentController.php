<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\Comment;
use App\Providers\TripcodeProvider;

class CommentController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'idea' => 'required|numeric',
            'name' => 'nullable|max:20|alpha_dash',
            'title' => 'required|min:5|max:80',
            'content' => 'required|min:10|max:1000'
        ]);

        $comment = Comment::create(['idea_id' => $request->post('idea'), 'name' => TripcodeProvider::crypt($request->post('name')), 'title' => $request->post('title'), 'content' => $request->post('content')]);
        return response($comment->id, 200);
    }
}
