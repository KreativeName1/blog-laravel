<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Parsedown;
use App\Models\Category;
use App\Http\Requests\PostRequest;
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

    public function store(PostRequest $request)
    {
      Post::create($request->validated());

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

    public function update(PostRequest $request, Post $post)
    {
      $post->update($request->validated());
      return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
      $post->delete();

      return redirect()->route('posts.index');
    }
}
