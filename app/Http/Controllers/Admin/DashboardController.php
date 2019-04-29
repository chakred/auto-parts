<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ViewCounter;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard(ViewCounter $viewCounter){
        $visitedPages = $viewCounter->all();
        return view ('admin.dashboard', compact('visitedPages'));
    }
}
