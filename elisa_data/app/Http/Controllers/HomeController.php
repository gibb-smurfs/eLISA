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
        $ideas = Idea::leftJoin(DB::raw('(SELECT idea_id, ROUND(AVG(rating), 2) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('created_at', 'desc')->paginate(8);
        return view('Home', ['ideas' => $ideas, 'pagination' => $ideas]);
    }

    public function top(Request $request)
    {
        $ideas = Idea::leftJoin(DB::raw('(SELECT idea_id, ROUND(AVG(rating), 2) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('avg_rating', 'desc')->take(10)->get();
        return view('Home', ['ideas' => $ideas]);
    }

    public function trending(Request $request) {
        $ideas = Idea::leftJoin(DB::raw('(SELECT idea_id, SUM(CASE WHEN created_at > DATE(NOW()) - INTERVAL 7 DAY THEN 1 ELSE 0 END) AS cnt_rating, ROUND(AVG(rating), 2) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('cnt_rating', 'desc')->take(10)->orderBy('avg_rating', 'desc')->get();
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
