<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome To Laravel!';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }
    
    public function about() {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }
    
    public function services() {
        $data = array(
            'title' => 'Services',
            'services' => ['Number 1', 'Number 2', 'Number 3', 'Number 4', 'Number 5']
        );
        return view('pages.services')->with($data);
    }
}
