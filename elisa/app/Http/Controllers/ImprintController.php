<?php

namespace App\Http\Controllers;

class ImprintController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('Imprint');
    }
}
