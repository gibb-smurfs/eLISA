<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'idea' => 'required|numeric',
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        $rating = Rating::create(['idea_id' => $request->post('idea'), 'rating' => $request->post('rating')]);

        return response($rating->id, 200);
    }
}
