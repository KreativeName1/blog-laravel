<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        //$allposts = Post::orderBy("id", "desc")->get();
        // get latest post by category_id
        $posts = Post::when(request('category_id'), function ($query) {
          $query->where('category_id', request('category_id'));
      })->latest()->get();
        // $values = [
        //     'categories' => $allCategories,
        //     'posts' => $allPosts,

        // ];
        // return view('home', $values);
        return view("home", compact("categories", "posts"));
    }
}
