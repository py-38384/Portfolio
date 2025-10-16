<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        return view('welcome');
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
        return view('blog.details');
    }
    public function test(){
        return view('test');
    }
}
