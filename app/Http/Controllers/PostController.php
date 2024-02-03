<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index', compact('category', 'post'));
    }
    public function createPost(Request $request)
    {
        //validation step
        $validator = $this->checkPostValidation($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!empty($request->imageName)) {
            //save image in public
            $file = $request->file('imageName');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);

            //save in database
            $data = $this->getPostData($request, $fileName);
        } else {
            $data = $this->getPostData($request, NULL);
        }

        Post::create($data);
        return back();
    }

    //get post data
    private function getPostData($request, $fileName)
    {
        return [
            'title' => $request->postName,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ];
    }

    //post validation check
    private function checkPostValidation($request)
    {
        return Validator::make($request->all(), [
            'postName' => 'required|min:3|max:50',
            'postDescription' => 'required',
            'postCategory' => 'required'
        ], [
            'postName' => 'အနည်းဆုံး၃လုံးထည့်ပေးပါဗျ'
        ]);
    }
}
