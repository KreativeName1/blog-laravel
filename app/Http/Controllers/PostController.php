<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Parsedown;
use App\Models\Category;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('posts.index', [
        'posts' => Post::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = Category::all();
      return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      Post::create([
        'title' => $request->input('title'),
        'text' => $request->input('text'),
        'user_id' => auth()->id(),
        'category_id' => Category::where('name', $request->input('category'))->first()->id
      ]);

      return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
      $Parsedown = new Parsedown();
      $post->text = $Parsedown->text($post->text);
      return view("post", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
      $categories = Category::all();
      return view('posts.edit',  compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
      $post->update([
        'title' => $request->input('title'),
        'text' => $request->input('text'),
        'category_id' => $request->input('category')
      ]);

      return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
      $post->delete();

      return redirect()->route('posts.index');
    }
}
