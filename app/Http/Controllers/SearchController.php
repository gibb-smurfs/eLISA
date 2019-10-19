<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct()
    {
    }

    public function search($query)
    {
        $search_results = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->orderBy('avg_rating', 'desc')->where('title', 'LIKE', "%$query%")->get();
        return view('Home', ['ideas' => $search_results]);
    }
}
