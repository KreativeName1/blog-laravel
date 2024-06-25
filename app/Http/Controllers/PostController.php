<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Parsedown;

class PostController extends Controller
{
  public function show(Post $post)
  {
      $Parsedown = new Parsedown();
      $post->text = $Parsedown->text($post->text);
      return view("post", compact("post"));
  }
}
