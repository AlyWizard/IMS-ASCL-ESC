<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the company selection page.
     * This is the main landing page where users choose between ESC and Alliance.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}