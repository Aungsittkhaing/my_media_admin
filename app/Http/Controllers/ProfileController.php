<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //direct admin profile
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->where('id', $id)->first();
        // dd($userInfo->toArray());
        return view('admin.profile.index')->with(['user' => $user]);
    }
    public function updateAdminAcount(Request $request)
    {
        $userData = $this->getUserInfo($request);
        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Admin account updated!']);
    }
    private function getUserInfo($request)
    {
        return [
            "name" => $request->adminName,
            "email" => $request->adminEmail,
            "phone" => $request->adminPhone,
            "address" => $request->adminAddress,
            "gender" => $request->adminGender,
            "updated_at" => Carbon::now()
        ];
    }
}
