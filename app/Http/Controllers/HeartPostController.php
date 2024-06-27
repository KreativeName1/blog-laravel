<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HeartPostController extends Controller
{
    public function heart(Post $post)
    {
      $post->hearts()->toggle(auth()->id());
      // return with success message and count of hearts (dont use back() method)
      $json = [
        'success' => true,
        'hearts' => $post->hearts->count()
      ];
      return response()->json($json);
    }
}
