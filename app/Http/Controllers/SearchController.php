<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function __construct()
    {
    }

    public function search(Request $request)
    {
        //@TODO: sanitize inputs

        $where_string = $this->build_where_string($request->input('search'));
        $search_results = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->whereRaw($where_string)->get();
        return view('Home', ['ideas' => $search_results]);
    }

    private function build_where_string($query)
    {
        
        $pattern = '/\s+/g';
        $replacement = "%' OR '%";
        
        $str = preg_replace($pattern, $replacement, trim($query));
  
        return "title LIKE '%$str%' OR content LIKE '%$str%'";
    }
}
