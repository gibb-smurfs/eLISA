<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Providers\TripcodeProvider;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class IdeaController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $ideas = Idea::orderBy('created_at', 'desc')->paginate(4);
        return response()->json($ideas);
    }

    public function top(Request $request)
    {
        $topIdeas = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('avg_rating', 'desc')->take(10)->get();
        return response()->json($topIdeas);
    }

    public function trending(Request $request) {
        $trendingIdeas = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating WHERE created_at > CURRENT_DATE - 7 GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('avg_rating', 'desc')->take(10)->get();
        return response()->json($trendingIdeas);
    }

    public function show($id)
    {
        $idea = Idea::with(['comments'])->find($id);
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
