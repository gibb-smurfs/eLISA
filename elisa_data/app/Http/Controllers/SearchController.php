<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function __construct()
    { }

    public function search(Request $request)
    {
        $where_string = $this->buildWhereString($request->input('query'));
        $search_results = Idea::whereRaw($where_string)->leftJoin(DB::raw('(SELECT idea_id, ROUND(AVG(rating), 2) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->get();
        return view('Home', ['ideas' => $search_results]);
    }

    private function buildWhereString($query)
    {
        $pattern = '/\s+/';
        $replacement = "%' OR '%";

        $str = preg_replace($pattern, $replacement, trim($query));

        return "title LIKE '%$str%' OR content LIKE '%$str%'";
    }
}
