<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $userData = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();

        return view('admin.list.index', compact('userData'));
    }
    public function adminAccountDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'User Account Deleted!']);
    }
}
