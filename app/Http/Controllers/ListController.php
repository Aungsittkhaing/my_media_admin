<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index()
    {
        $userData = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();

        return view('admin.list.index', compact('userData'));
    }
    //delete admin account
    public function adminAccountDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'User Account Deleted!']);
    }
    //admin list search
    public function adminListSearch(Request $request)
    {
        $userData = User::OrWhere('name', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->OrWhere('email', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->OrWhere('phone', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->OrWhere('address', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->OrWhere('gender', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->get();
        return view('admin.list.index', compact('userData'));
    }
}
