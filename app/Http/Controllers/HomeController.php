<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $ideas = Idea::orderBy('id')->paginate(8);
        return view('Home', ['ideas' => $ideas]);
    }

    public function top(Request $request)
    {
        $ideas = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('avg_rating', 'desc')->take(10)->get();
        return view('Home', ['ideas' => $ideas]);
    }

    public function trending(Request $request) {
        $ideas = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating WHERE created_at > CURRENT_DATE - 7 GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('avg_rating', 'desc')->take(10)->get();
        return view('Home', ['ideas' => $ideas]);
    }

    public function show($id)
    {
        $idea = Idea::with(['comments', 'ratings'])->find($id);
        return view('Idea', ['idea' => $idea]);
    }

    public function new()
    {
        return view('New');
    }
}
