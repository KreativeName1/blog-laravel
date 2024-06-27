<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Parsedown;
use App\Models\Category;
class PostController extends Controller
{

    public function index()
    {
      $posts = Post::with('category')->get();
      return view('posts.index', compact('posts'));
    }

    public function create()
    {
      $categories = Category::all();
      return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
      Post::create([
        'title' => $request->input('title'),
        'text' => $request->input('text'),
        'category_id' => $request->input('category'),
        'user_id' => auth()->id()
      ]);

      return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
      return view("post", compact("post"));
    }

    public function edit(Post $post)
    {
      $categories = Category::all();
      return view('posts.edit',  compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
      $post->update([
        'title' => $request->input('title'),
        'text' => $request->input('text'),
        'category_id' => $request->input('category')
      ]);

      return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
      $post->delete();

      return redirect()->route('posts.index');
    }
}
