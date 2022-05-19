<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Date;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.list', compact('posts'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          ]);

          if ($validator->fails()) {
            return redirect('posts/create')
                     ->withErrors($validator)
                     ->withInput();
          }else {


            // Initialize empty Post object
            $post = new Post();
            // Initialize empty Post object

            // file from the form field
            $file = $request->file('image');
            // file from the form field

            // $filename = $request->user()->from_date->format('d/m/Y').$file->getClientOriginalName();

            $filename = $file->getClientOriginalName();
            $file-> move(public_path('images/'), $filename);

            $post['user_id'] = $request->user()->id;
            $post['title'] = $request->post('title');
            $post['text'] = $request->post('text');
            // $post['name'] = $filename;
            $post['name'] = 'images/' . $request->file('image')->getClientOriginalName();
            $post->save();
            return redirect('/posts')->with('success', "{$post['title']} created.");
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
