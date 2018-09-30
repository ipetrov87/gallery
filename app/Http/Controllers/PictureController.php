<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePicture;
use App\Tag;

class PictureController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $page = Picture::paginate(6);
            return $page;
        }

        return view('picture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('picture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StorePicture  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePicture $request)
    {
        $picture = $request->validated();
        
        $path = $request->file('picture')->store(
            $request->user()->id .'/pictures', 'public'
        );
        $picture['picture'] = '/storage/'. $path;

        $tags = explode(',', $picture['tags']);
        
        $picture = Auth::user()->pictures()->create($picture);
        
        foreach ($tags as $key => $value) {
            $tag = Tag::firstOrCreate(['name' => $value, 'slug' => str_slug($value)]);
            $picture->tags()->attach($tag);
        }

        return $picture;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        // return view('picture.show', [
        //     'picture' => $picture,
        // ]);

        return view('picture.show')->with('picture', $picture);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Picture $picture)
    {
        //
    }
}
