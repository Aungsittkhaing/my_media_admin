<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index', compact('category', 'post'));
    }
    //post creation
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
        return back()->with(['postSuccess' => 'post is added successfully!']);
    }
    //post delete
    public function deletePost($id)
    {
        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData->image;
        Post::where('post_id', $id)->delete(); //delete data from database

        if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
            File::delete(public_path() . '/postImage/' . $dbImageName);
        }
        return back()->with(['deleteSuccess' => 'post is deleted!']);
    }
    //direct edit post
    public function editPost($id)
    {
        $postDetail = Post::where('post_id', $id)->first();
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.edit', compact('postDetail', 'category', 'post'));
    }
    //update post
    public function updatePost($id, Request $request)
    {
        //validation step
        $validator = $this->checkPostValidation($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $updateData = $this->requestUpdatePostData($request);
        if (isset($request->imageName)) {
            $this->storeNewUpdateImage($id, $request, $updateData);
        } else {
            Post::where('post_id', $id)->update($updateData);
        }
        return back()->with(['postSuccess' => 'post is updated successfully!']);
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
    //request update postdata
    private function requestUpdatePostData($request)
    {
        return [
            'title' => $request->postName,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now()
        ];
    }
    //store new update image
    private function storeNewUpdateImage($id, $request, $updateData)
    {
        //save image in public
        $file = $request->file('imageName');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();

        //put new image to data array
        $updateData['image'] = $fileName;

        //get image name from database
        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData->image;

        //delete image from public folder
        if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
            File::delete(public_path() . '/postImage/' . $dbImageName);
        }
        //store new image under public folder
        $file->move(public_path() . '/postImage', $fileName);

        //update data from the database
        Post::where('post_id', $id)->update($updateData);
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
