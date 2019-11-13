<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "Welcome";
        return view('pages.index', compact('title'));
    } 

    public function mens() {
        $title = "Mens";
        return view('pages.mens')->with('title', $title);
    } 

    public function services() {
        $data = array(
            'title' => 'Services',
            'services' => ['Python', 'Bad PHP']
        );
        return view('pages.services') ->with($data);
    } 
}
