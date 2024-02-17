<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    public function index()
    {
        $post = ActionLog::select('action_logs.*', 'posts.*', DB::raw('COUNT(action_logs.post_id) as post_count'))
            ->leftJoin('posts', 'posts.post_id','action_logs.post_id')
            ->groupBy('action_logs.post_id')//COUNT MAX MIN => DB:raw
            ->get();
        return view('admin.trend_post.index', compact('post'));
    }

    public function trendPostDetails($id)
    {
        $post = Post::where('post_id', $id)->first();
        return view('admin.trend_post.details', compact('post'));
    }
}
