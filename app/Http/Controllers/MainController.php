<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $remedios = Remedio::all();
        return view('home', compact('remedios'));
    }
}
