<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use function Termwind\render;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('App/HomeView');
    }
}
