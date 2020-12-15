<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->with('comment')->latest()->get();
        return view('home')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->description = $request->description;

        if($request->filled('description')){
            $post->save();
            return redirect()->back()->with('success', 'Post Created.');
        }else if($request->has('image') || $request->filled('description')){
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $rename = Uuid::uuid4().'.'.$extension;
            $image->move(public_path('images'), $rename);
            $post->image = $rename;
            $post->save();
            return redirect()->back()->with('success', 'Post Created.');
        }else{
            return redirect()->back()->with('danger', 'Write a description or add an image!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('editpost')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post=Post::find($request->id);
        $post->description = $request->description;

        if($request->filled('description')){
            $post->save();
            return redirect('/')->with('success', 'Changes Saved.');
        }else{
            return redirect()->back()->with('danger', 'Please write a description!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted.');
    }
}
