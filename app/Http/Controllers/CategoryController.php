<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index', compact('category'));
    }
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
