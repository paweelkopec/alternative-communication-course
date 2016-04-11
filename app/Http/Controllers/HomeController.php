<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller{
    
    public function index(Request $request) {
        
        return view('home', [
            'courses' => \App\Models\Course::all()
        ]);
        
    }
}
