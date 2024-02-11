<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get all category
    public function getAllCategory()
    {
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
           'category' => $category
        ]);
    }

    //category search with displaying post
    public function categorySearch(Request $request)
    {
        $category = Post::where('title', 'like', '%' .$request->key. '%')->get();
        return response()->json([
            "searchValue" => $category
        ]);
    }
}
