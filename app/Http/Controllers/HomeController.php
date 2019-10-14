<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

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
