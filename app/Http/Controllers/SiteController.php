<?php

namespace App\Http\Controllers;

use App\Facades\EditorJsDataToHtml;
use App\Models\Blog;
use App\Models\Console;
use App\Models\File;
use App\Models\Project;
use App\Models\Frontend;
use App\Models\SocialIcon;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        $console = Console::all();
        $projects = Project::with('category')->orderBy('created_at','desc')->where('status','published')->where('is_featured',1)->limit(5)->get();
        $blogs = Blog::orderBy('created_at','desc')->where('status','published')->limit(3)->get();
        $testimonials = Testimonial::all();
        return view('welcome', compact('console','projects', 'blogs', 'testimonials'));
    }
    public function portfolios(){
        $projects = Project::with('category')->orderBy('created_at','desc')->where('status','published')->paginate(5);
        return view('projects.portfolio', compact('projects'));
    }
    public function portfolios_details(Project $project){
        $project->descriptionHtml = EditorJsDataToHtml::parse($project->description);
        return view('projects.details', compact('project'));
    }
    public function blogs(){
        $blogs = Blog::orderBy('created_at','desc')->where('status','published')->paginate(5);
        return view('blogs', compact('blogs'));
    }
    public function blogs_details(Blog $blog){
        $blog->blog_content_html = EditorJsDataToHtml::parse($blog->description);
        return view('blogs.details', compact('blog'));
    }
    public function about(){
        return view('about');
    }
    public function contact(){
        $social_icons = SocialIcon::all();
        return view('contact', compact('social_icons'));
    }
    public function view_file($path){
        $pos = strrpos($path, '/');
        $file_path = '/'.substr($path, 0, $pos);
        $file_id = substr($path, $pos + 1);
        $file = File::where('file_id',$file_id)->where('path',$file_path)->where('public',1)->first();
        if($file){
            return response()->file($file->stored_path);
        }
        abort(404);
    }
}
