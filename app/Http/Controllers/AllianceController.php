<?php
// File: app/Http/Controllers/AllianceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllianceController extends Controller
{
     /**
     * Show the dashboard for Alliance users.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('alliance.dashboard');
    }
}
