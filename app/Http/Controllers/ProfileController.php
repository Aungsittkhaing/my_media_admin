<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $validator = $this->userValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Admin account updated!']);
    }
    //direct change password
    public function changingPassword()
    {
        return view('admin.profile.changePassword');
    }
    //change password
    public function changePassword(Request $request)
    {
        $validator = $this->passwordValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        $hashUserPassword = Hash::make($request->newPassword);
        $old = Hash::make($request->oldPassword);

        $updateData = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        } else {
            return back()->with(['fail' => 'passwordမှန်အောင်ထည့်မအေလိုး!']);
        }
    }

    //get user info
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
    //user validation check
    private function userValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required'
        ]);
    }
    //password validation check
    private function passwordValidationCheck($request)
    {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'passwordConfirmation' => 'required|same:newPassword|min:8|max:15'
        ];
        $validationMessages = [
            'confirmPassword.same' => 'New password & Confirm password must be same!'
        ];
        return Validator::make($request->all(), $validationRules, $validationMessages);
    }
}
