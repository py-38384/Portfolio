<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Frontend;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        $console = Console::all();
        return view('welcome', compact('console'));
    }
    public function portfolios(){
        return view('projects.portfolio');
    }
    public function portfolios_details($id){
        return view('projects.details');
    }
    public function blogs(){
        return view('blogs');
    }
    public function blogs_details($id){
        return view('blogs.details');
    }
    public function test(){
        return view('test');
    }
}
