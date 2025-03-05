<?php
// File: app/Http/Controllers/EscController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscController extends Controller
{
    /**
     * Show the dashboard for ESC users.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('esc.dashboard');
    }
}