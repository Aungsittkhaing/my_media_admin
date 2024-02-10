<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPost()
    {
        $post = Post::get();
        return response()->json([
            'post' => $post
        ]);
    }
}
