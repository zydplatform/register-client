<?php

namespace App\Http\Controllers;

use Illuminate\Http\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts= Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=> 'required|maximum:255',
            'body'=> 'required'
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index')
        ->with('success', 'Posts created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $post = Post::find($id);
        
        return view('posts.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'title' => 'required|maximum:255',
            'body' => 'required'
        ]);

        $post = Post::find($id);
        $post->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $post = Post::find($id);
        $post-> delete();

        return redirect-> route('posts.index')
        ->with('success', "Post deleted successfully");
    }

    public function create(){
        return view('posts.create');
    }
}
