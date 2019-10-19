<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Providers\TripcodeProvider;

class IdeaController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $ideas = Idea::with(['comments', 'ratings'])->orderBy('id')->paginate(4);
        return response()->json($ideas);
    }

    public function show($id)
    {
        $idea = Idea::with(['comments', 'ratings'])->find($id);
        return response()->json($idea);
    }

    public function create(Request $request)
    {
        //@TODO: sanitization

        $this->validate($request, [
            'name' => 'nullable|max:20|alpha_dash',
            'email' => 'required|email|max:60',
            'title' => 'required|min:5|max:80',
            'content' => 'required|min:10|max:1000'
        ]);

        $idea = Idea::create(['name' => TripcodeProvider::crypt($request->post('name')), 'email' => $request->post('email'), 'title' => $request->post('title'), 'content' => $request->post('content')]);
        return response($idea->id, 200);
    }
}
