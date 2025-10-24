<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Console;
use App\Models\Project;
use App\Models\Frontend;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        $console = Console::all();
        $projects = Project::with('category')->orderBy('created_at','desc')->where('status','published')->limit(5)->get();
        $blogs = Blog::orderBy('created_at','desc')->where('status','published')->limit(5)->get();
        return view('welcome', compact('console','projects','blogs'));
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
    public function about(){
        return view('about');
    }
    public function test(){
        return view('test');
    }
}
