<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Console;
use App\Models\Contact;
use App\Models\Frontend;
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
        $title = 'Admin Dashboard';
        $contacts = Contact::orderBy('created_at','desc')->paginate(10);
        return view('dashboard',compact('title','contacts'));
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
        $title = 'Frontend Data';

        $frontend = Frontend::getItem();
        $frontend->skills_icons = json_decode($frontend->about_skills_image);
        return view('admin.frontend.form', compact('frontend','title'));
    }
    public function frontend_store(Request $request){
        $frontend = Frontend::getItem();
        $frontend->name = $request->name;
        $frontend->hero_brief = $request->hero_brief;

        $hero_image = '';
        if($frontend->hero_image){
            $hero_image = $frontend->hero_image;
        }
        if($request->hasFile('hero_image')){
            $this->batchDelete($hero_image, public_path('uploads/images/frontend/hero_image'));
            $hero_image = $this->imageUploadKeepOriginalName(file: $request->hero_image, full_path: public_path("uploads/images/frontend/hero_image"), only_name: true);
        }
        $frontend->hero_image = $hero_image;

        $frontend->portfolio_title = $request->portfolio_title;
        $frontend->portfolio_desc = $request->portfolio_desc;

        $frontend->about_title = $request->about_title;
        $frontend->about_desc = $request->about_desc;

        $about_image = '';
        if($frontend->about_image){
            $about_image = $frontend->about_image;
        }
        if($request->hasFile('about_image')){
            $this->batchDelete($about_image, public_path('uploads/images/frontend/about_image'));
            $about_image = $this->imageUploadKeepOriginalName(file: $request->about_image, full_path: public_path("uploads/images/frontend/about_image"), only_name: true);
        }
        $frontend->about_image = $about_image;

        $frontend->about_story_title = $request->about_story_title;
        $frontend->about_story = $request->about_story;

        $about_skills_images = [];
        if($frontend->about_skills_image){
            $about_skills_images = json_decode($frontend->about_skills_image, true);
        }
        if($request->about_skills_images && is_array($request->about_skills_images) && count($request->about_skills_images) > 0){
            $this->batchDelete($about_skills_images, public_path('uploads/images/frontend/skills_icons/'));
            $about_skills_images = [];
            foreach($request->about_skills_images as $gallery_image){
                $about_skills_images[] = $this->imageUploadKeepOriginalName(file: $gallery_image, full_path: public_path("uploads/images/frontend/skills_icons/"), only_name: true,);
            }
        }
        $frontend->about_skills_image = json_encode($about_skills_images);
        $frontend->about_button_text = $request->about_button_text;
        $frontend->blog_title = $request->blog_title;
        $frontend->blog_desc = $request->blog_desc;
        $frontend->contact_title = $request->contact_title;
        $frontend->contact_desc = $request->contact_desc;
        
        $contact_image = '';
        if($frontend->contact_image){
            $contact_image = $frontend->contact_image;
        }
        if($request->hasFile('contact_image')){
            $this->batchDelete($contact_image, public_path('uploads/images/frontend/contact_image'));
            $contact_image = $this->imageUploadKeepOriginalName(file: $request->contact_image, full_path: public_path("uploads/images/frontend/contact_image"), only_name: true);
        }
        $frontend->contact_image = $contact_image; 
        $frontend->copyright_text = $request->copyright_text;

        $frontend->current_theme_color = $request->current_theme_color;
        if($request->current_theme_color == 'custom'){
            $colors = [
                "primary_body_color" => $request->primary_body_color,
                "active_text_color" => $request->active_text_color,
                "outline_default_color" => $request->outline_default_color,
                "box_shadow_color" => $request->box_shadow_color,
            ];
            $frontend->theme_colors = $colors;
        }

        $frontend->save();
        Alert::toast('Frontend Data Update','success');
        return redirect()->route('frontend.index');
    }
    public function console(){
        $title = 'Console Data';

        $consoles = Console::paginate(10);

        return view('admin.console.index', compact('consoles','title'));
    }
    public function console_create(){
        $title = 'Property Create';
        return view('admin.console.form', compact('title'));
    }
    public function console_store(Request $request, Console $console = null){
        $request->validate([
            'property' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);
        $created = true;
        if($console){
            $created = false;
        } else {
            $console = new Console();
        }
        $console->property = $request->property;
        $console->type = $request->type;
        $console->status = $request->status;
        if($console->type == 'string'){
            $value = ['string' => $request->string, 'link' => $request->link];
            $console->content = $value;
        }
        if($console->type == 'array'){
            $console->content = $request->value;
        }
        $console->save();
        if($created){
            Alert::toast('Console Data Updated','success');
        } else {
            Alert::toast('Console Data Created','success');
        }
        return redirect()->route('console.index');
    }
    public function console_edit(Console $console){
        $title = 'Property Edit';
        return view('admin.console.form', compact('console','title'));
    }
    public function console_delete(Console $console = null){
        $console->delete();
        Alert::toast('Console Data Deleted','success');
        return redirect()->route('console.index');
    }
    public function save_contact(Request $request){
        $request->validate([
            "subject" => "required",
            "full_name" => "required",
            "email" => "required|email",
            "message" => "required",
        ]);
        Contact::create([
            "subject" => $request->subject,
            "full_name" => $request->full_name,
            "email" => $request->email,
            "message" => $request->message,
        ]);
        Alert::toast('Message Successfully Sent','success');
        return redirect()->route('home');
    }
    public function view_contact(Contact $contact){
        $title = 'Contact Message From '.$contact->email;
        return view('admin.contact.show',compact('title','contact'));
    }
    public function delete_contact(Contact $contact){
        $contact->delete();
        Alert::toast('Contact Message Deleted','success');
        return redirect()->route('dashboard');
    }
}