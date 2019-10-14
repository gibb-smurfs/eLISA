<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

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
        $name = $request->input('name');
        $email = $request->input('email');
        $title = $request->input('title');
        $content = $request->input('content');

        if ($name && $email && $title && $content) {
            Idea::create(['name' => $name, 'email' => $email, 'title' => $title, 'content' => $content]);
            return response('1', 200);
        } else {
            return response('0', 400);
        }
    }
}
