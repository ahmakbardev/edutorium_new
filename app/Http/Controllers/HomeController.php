<?php

namespace App\Http\Controllers;

use App\Models\TugasAkhirSubmission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $submissions = TugasAkhirSubmission::with('user')->latest()->limit(9)->get();
        return view('index', compact('submissions'));
    }
}
