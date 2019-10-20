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
        $where_string = $this->build_where_string($query);
        $search_results = Idea::leftJoin(DB::raw('(SELECT idea_id, AVG(rating) AS avg_rating FROM t_rating GROUP BY idea_id) a'), 'id', '=', 'idea_id')->select('id', 'name', 'title', 'content', 'created_at', 'updated_at', 'avg_rating')->whereRaw($where_string)->get();
        return view('Home', ['ideas' => $search_results]);
    }

    private function build_where_string($query)
    {
        $query_parts = explode('+', $query);
        $where_string = '';
        $counter = 0;
        foreach ($query_parts as $query_part)
        {
            if ($counter != 0) {
                $where_string .= " OR ";
            }
            $where_string .= "title LIKE \"%$query_part%\" OR content LIKE \"%$query_part%\"";
            $counter += 1;
        }
        return $where_string;
    }
}
