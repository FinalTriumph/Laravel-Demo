<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// To delete uploaded images with Laravel 5.3
use Illuminate\Support\Facades\Storage;
///////

// To delete uploaded images with Laravel 5.2
use File;
///////

use App\Http\Requests;

use App\Post;

/* DB part 1/2
use DB;
*/


class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* DB part 2/2
        $posts = DB::select('SELECT * FROM posts');
        */
        
        //$posts = Post::all();
        
        //$posts = Post::orderBy('created_at', 'desc')->take(1)->get();
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        
        //$posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|max:1999' // for laravel 5.3 add |nullable|
            ]);
            
        // Handle File Upload
        
        if ($request->hasFile('cover_image')) {
            
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            // Upload image
            /* For Laravel 5.3
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            */
            
            /* For Laravel 5.2 
            if ($request->file('cover_image')->isValid()) {
            */
                //$path = $request->file('cover_image')->move('public/cover_images', $fileNameToStore);
                $request->file('cover_image')->move('cover_images', $fileNameToStore);
            /*
            }
            */
            
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
            
        // Create Post
        $post = new Post;
        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        
        $post->save();
        
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Post::where('id', $id)->get();
        
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        // Check for correct user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|max:1999' // for laravel 5.3 add |nullable|
            ]);
        
        // Find And Update Post
        $post = Post::find($id);
        
        // Check for correct user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        
        // Handle File Upload
        
        if ($request->hasFile('cover_image')) {
            
            if($post->cover_image !== 'noimage.jpg') {
                // Delete old image
                /* For Laravel 5.3
                Storage::delete('public/cover_images/'.$post->cover_image);
                */
            
                File::delete('cover_images/'.$post->cover_image);
            }
            
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            // Upload image
            /* For Laravel 5.3
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            */
            
            /* For Laravel 5.2 
            if ($request->file('cover_image')->isValid()) {
            */
                //$path = $request->file('cover_image')->move('public/cover_images', $fileNameToStore);
                $request->file('cover_image')->move('cover_images', $fileNameToStore);
            /*
            }
            */
        }
        ////////////////////
        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        
        $post->save();
        
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        // Check for correct user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        if($post->cover_image !== 'noimage.jpg') {
            // Delete image
            /* For Laravel 5.3
            Storage::delete('public/cover_images/'.$post->cover_image);
            */
            
            File::delete('cover_images/'.$post->cover_image);
        }
        
        $post->delete();
        
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
