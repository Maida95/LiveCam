<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Home Page';
        return view('pages.index') -> with('title', $title);
    }

    public function webshop(){
        $title = 'Webshop';
        return view('pages.webshop') -> with('title', $title);
    }

    public function LiveCam(){
        return view('forms.create');
    }

    public function unos(){
        return view('forms.create');
    }

    public function prikaz(){
        return view('forms.index');
    }
    
}
