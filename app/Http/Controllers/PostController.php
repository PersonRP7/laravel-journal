<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Date;

use Carbon\Carbon;

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

            $filename = Carbon::now()->toDateTimeString() . $file->getClientOriginalName();
            $file-> move(public_path('images/'), $filename);
            // $file-> move('/storage/app/public/images/', $filename);

            $post['user_id'] = $request->user()->id;
            $post['title'] = $request->post('title');
            $post['text'] = $request->post('text');
            // $post['name'] = $filename;
            $post['name'] = 'images/' . Carbon::now()->toDateTimeString() . $request->file('image')->getClientOriginalName();
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
        return view('posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|unique:posts|max:255',
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          ]);

          if ($validator->fails()) {
            return redirect('posts/create')
                     ->withErrors($validator)
                     ->withInput();
          }else {

          $textFields = ["title", "text"];
          // foreach ($textFields as $textField) {
          //   $request->whenFilled($textField, function (Request $request) {
          //     $post[$textField] = $request->post($textField);
          //   });
          // }
          foreach ($textFields as $textField) {
            if ($request->filled($textField))
            {
              $post[$textField] = $request->post($textField);
            }
          }

          if ($request->file('image'))
          {
            $post['name'] = 'images/' . Carbon::now()->toDateTimeString() . $request->file('image')->getClientOriginalName();
            $file = $request->file('image');
            $filename = Carbon::now()->toDateTimeString() . $file->getClientOriginalName();
            $file-> move(public_path('images/'), $filename);
          }

          // $request->whenFilled('image', function ($input) {
            // $post['name'] = 'images/' . Carbon::now()->toDateTimeString() . $request->file('image')->getClientOriginalName();
            // $file = $request->file('image');
            // $filename = Carbon::now()->toDateTimeString() . $file->getClientOriginalName();
            // $file-> move(public_path('images/'), $filename);
          // });

          $post->save();
            // file from the form field
            // $file = $request->file('image');
            // file from the form field

            // $filename = Carbon::now()->toDateTimeString() . $file->getClientOriginalName();
            // $file-> move(public_path('images/'), $filename);
            // $file-> move('/storage/app/public/images/', $filename);

            // $post['user_id'] = $request->user()->id;
            // $post['title'] = $request->post('title');
            // $post['text'] = $request->post('text');
            // // $post['name'] = $filename;
            // $post['name'] = 'images/' . Carbon::now()->toDateTimeString() . $request->file('image')->getClientOriginalName();
            // $post->save();
            return redirect('/posts')->with('success', "{$post['title']} updated.");
          }
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
