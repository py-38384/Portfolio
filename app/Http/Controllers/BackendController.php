<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }
    public function projects(){
        return view('admin.projects.index');
    }
    public function projects_create(){
        return view('admin.projects.form');
    }
    public function projects_store(Request $request){
        
        $request->validate([
            'project_title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'status' => 'required|string',
        ]);

        

        $project = Project::create([

        ]);
        
        return "projects_store";
    }
    public function projects_edit(){
        return "projects_edit";
    }
    public function projects_update(){
        return "projects_update";
    }
    public function projects_delete(){
        return "projects_delete";
    }

    public function blogs(){
        return "blogs";
    }
    public function blogs_create(){
        return "blogs_create";
    }
    public function blogs_store(){
        return "blogs_store";
    }
    public function blogs_edit(){
        return "blogs_edit";
    }
    public function blogs_update(){
        return "blogs_update";
    }
    public function blogs_delete(){
        return "blogs_delete";
    }
}
