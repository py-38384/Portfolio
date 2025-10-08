<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        return view('welcome');
    }
    public function portfolios(){
        return view('portfolio');
    }
    public function blogs(){
        return view('blogs');
    }
}
