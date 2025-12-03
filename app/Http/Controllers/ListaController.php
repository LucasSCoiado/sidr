<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function index()
    {
        $remedios = Remedio::all();
        return view('lista.home', compact('remedios'));
    }
}
