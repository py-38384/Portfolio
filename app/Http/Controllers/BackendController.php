<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class BackendController extends Controller
{
    public function save_project_darft(Request $request){
        $content = $request->data;
        Cache::put('projectCache', $content);
        return ['status' => "success", 'message' => 'Project Data Cached!'];
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function projects(){
        $title = 'All Projects';
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects','title'));
    }
    public function projects_create(){
        $cached_project = Cache::get('projectCache');
        $title = 'Create New Project';
        return view('admin.projects.form', compact('cached_project','title'));
    }
    public function projects_store(Request $request, Project $project = null){
        if($project){
            $request->validate([
                'project_title' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'status' => 'required|string',
            ]);
        } else {
            $request->validate([
                'project_title' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'status' => 'required|string',
                'hero_image' => 'required',
                'gallery_images' => 'required',
            ]);
        }
        
        $hero_image = '';
        if($project){
            $hero_image = $project->hero_image;
        }

        if($request->hasFile('hero_image')){
            $this->batchDelete($hero_image, public_path('uploads/images/projects/'));
            $hero_image = $this->imageUploadKeepOriginalName(file: $request->hero_image, full_path: public_path("uploads/images/projects"), only_name: true);
        }
        
        $gallery_images = [];
        if($project){
            $gallery_images = json_decode($project->gallery_image, true);
        }

        if($request->gallery_images && is_array($request->gallery_images) && count($request->gallery_images) > 0){
            $this->batchDelete($gallery_images, public_path('uploads/images/projects/gallery/'));
            $gallery_images = [];
            foreach($request->gallery_images as $gallery_image){
                $gallery_images[] = $this->imageUploadKeepOriginalName(file: $gallery_image, full_path: public_path("uploads/images/projects/gallery"), only_name: true,);
            }
        }
        $data = [
                'project_title' => $request->project_title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'status' => $request->status,
                'hero_image' => $hero_image,
                'gallery_image' => json_encode($gallery_images),
        ];
        $is_created = true;
        if($project){
            $project->update($data);
            $is_created = false;
        } else {
            Project::create($data);
        }
        Cache::forget('projectCache');
        if($is_created){
            Alert::toast('Project Created','success');
        } else {
            Alert::toast('Project Update','success');
        }
        return redirect()->route('projects.index');
    }
    public function projects_edit(Project $project){
        $title = 'Update Project - '.$project->project_title;
        $project->gallery_images = json_decode($project->gallery_image);
        return view('admin.projects.form', compact('project', 'title'));
    }
    public function projects_delete(Project $project){
        $hero_image = $project->hero_image;
        $this->batchDelete($hero_image, public_path('uploads/images/projects/'));
        
        $gallery_images = json_decode($project->gallery_image, true);
        $this->batchDelete($gallery_images, public_path('uploads/images/projects/gallery/'));

        $project->delete();
        Alert::toast('Project Deleted','success');
        return redirect()->route('projects.index');
    }

    public function save_blog_darft(Request $request){
        $content = $request->data;
        Cache::put('blogCache', $content);
        return ['status' => "success", 'message' => 'Blog Data Cached!'];
    }
    public function blogs(){
        $title = 'All Blogs';
        $blogs = Blog::paginate(10);
        return view('admin.blogs.index', compact('blogs','title'));
    }
    public function blogs_create(){
        $cached_blog = Cache::get('blogCache');
        $title = 'Create New Blog';
        return view('admin.blogs.form', compact('cached_blog','title'));
    }
    public function blogs_store(Request $request, Blog $blog = null){
        if($blog){
            $request->validate([
                'blog_title' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'status' => 'required|string',
            ]);
        } else {
            $request->validate([
                'blog_title' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'status' => 'required|string',
                'hero_image' => 'required',
            ]);
        }
        $hero_image = '';
        if($blog){
            $hero_image = $blog->hero_image;
        }
        if($request->hasFile('hero_image')){
            $this->batchDelete($hero_image, public_path('uploads/images/blogs/'));
            $hero_image = $this->imageUploadKeepOriginalName(file: $request->hero_image, full_path: public_path("uploads/images/blogs"), only_name: true);
        }
        $data = [
                'blog_title' => $request->blog_title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'status' => $request->status,
                'hero_image' => $hero_image,
        ];
        $is_created = true;
        if($blog){
            $blog->update($data);
            $is_created = false;
        } else {
            Blog::create($data);
        }
        Cache::forget('blogCache');
        if($is_created){
            Alert::toast('Blog Created','success');
        } else {
            Alert::toast('Blog Update','success');
        }
        return redirect()->route('blogs.index');
    }
    public function blogs_edit(Blog $blog){
        $title = 'Update Blog - '.$blog->project_title;
        $blog->gallery_images = json_decode($blog->gallery_image);
        return view('admin.blogs.form', compact('blog', 'title'));
    }
    public function blogs_update(){
        return "blogs_update";
    }
    public function blogs_delete(Blog $blog){
        $hero_image = $blog->hero_image;
        $this->batchDelete($hero_image, public_path('uploads/images/blogs/'));

        $blog->delete();
        Alert::toast('Blog Deleted','success');
        return redirect()->route('blogs.index');
    }

    public function frontend(){
        return "frontend";
    }
}
