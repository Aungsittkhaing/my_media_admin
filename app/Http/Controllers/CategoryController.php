<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index', compact('category'));
    }
    //create category
    public function createCategory(Request $request)
    {
        $validator = $this->categoryValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $this->getCategoryData($request);
        Category::create($data);
        return back()->with(['categorySuccess' => 'category is updated!']);
    }
    //delete category
    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();
        return redirect()->route('admin.category')->with(['deleteSuccess' => 'category is deleted!']);
        // return back()->with(['deleteSuccess' => 'category is deleted!']);
    }
    //category edit
    public function categoryEditPage($id)
    {
        $category = Category::get();
        $updateCategory = Category::where('category_id', $id)->first();
        return view('admin.category.edit', compact('category', 'updateCategory'));
    }
    //category update
    public function updateCategory($id, Request $request)
    {
        $validator = $this->categoryValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $updateCategoryData = $this->getUpdateData($request);
        Category::where('category_id', $id)->update($updateCategoryData);
        return redirect()->route('admin.category')->with(['categoryUpdated' => 'category is updated!']);
    }

    //category search
    public function categorySearch(Request $request)
    {
        $category = Category::where('title', 'like', '%' . $request->categorySearch . '%')->get();
        return view('admin.category.index', compact('category'));
    }

    //get category data
    private function getCategoryData($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    //get update category
    private function getUpdateData($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now()
        ];
    }
    //category validation check
    private function categoryValidationCheck($request)
    {
        $validationRules = [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ];
        $validationMessages = [
            'categoryName' => 'Category nameလေးထည့်ပေးပါဗျ',
            'categoryDescription' => 'Category Descriptionလေးထည့်ပေးပါဗျ'
        ];
        return Validator::make($request->all(), $validationRules, $validationMessages);
    }
}
