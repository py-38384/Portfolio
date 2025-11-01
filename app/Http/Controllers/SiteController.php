<?php

namespace App\Http\Controllers;

use App\Facades\EditorJsDataToHtml;
use App\Models\Blog;
use App\Models\Console;
use App\Models\Project;
use App\Models\Frontend;
use App\Models\SocialIcon;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        $console = Console::all();
        $projects = Project::with('category')->orderBy('created_at','desc')->where('status','published')->limit(5)->get();
        $blogs = Blog::orderBy('created_at','desc')->where('status','published')->limit(5)->get();
        $testimonials = Testimonial::all();
        return view('welcome', compact('console','projects', 'blogs', 'testimonials'));
    }
    public function portfolios(){
        return view('projects.portfolio');
    }
    public function portfolios_details(Project $project){
        $project->descriptionHtml = EditorJsDataToHtml::parse($project->description);
        return view('projects.details', compact('project'));
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
    public function contact(){
        $social_icons = SocialIcon::all();
        return view('contact', compact('social_icons'));
    }
    public function test(){
        return view('test');
    }
}
