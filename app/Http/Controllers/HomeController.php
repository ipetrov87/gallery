<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;

class HomeController extends Controller
{
    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Picture::latest()->limit(6)->get();
        return view('home.index', compact('pictures'));
    }
}
