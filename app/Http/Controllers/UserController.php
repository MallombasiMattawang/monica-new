<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MstMitra;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($role = null, $userId = null)
    {

        $pageTitle  = "Profil";
        $breadcrumb = [
            'Profil',
            'Pengguna',
            getUser()->name
        ];
        if (empty($userId)) {
            // login menggunakan akunnya sendiri;
            $profil = getUser();
            $getRole = activeGuard();
            $getUserId = auth($getRole)->user()->id;
        } else {

            // tampilkan profil dari akun admin;
            $profil = $this->selectUser($role, $userId);
            $getRole = $role;
            $getUserId = $userId;
        }

        // return $profil;

        return view(
            'pengguna.pages.user.profile',
            compact('pageTitle', 'breadcrumb', 'profil', 'getRole', 'getUserId')
        );
    }

    public function selectUser($role, $id)
    {
        if ($role == "mitra") {
            $get = MstMitra::where('id', $id)->select('id', 'nama_mitra AS name', 'username')->first();
        }

        if ($role == "web") {
            $get = User::where('id', $id)->first();
        }

        return $get;
    }

    public function userData($request,$fileName)
    {
        $role = $request->role;

        if ($role == "mitra") {
            $data = [
                'nama_mitra' => $request->name,
                'username' => $request->email,
                'avatar' => $fileName
            ];
        }elseif ($role == "web") {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'foto' => $fileName
            ];

        }else{
            $data = [
                'nama' => $request->name,
                'email' => $request->email,
                'foto' => $fileName
            ];
        }

        return $data;
    }

    public function validatePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role' => 'required',
            'userId' => 'required',
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }


        $get = getUserId($request->role, $request->userId);
        $oldPasswordCheck  = $get->password;

        #Match The Old Password
        if (!Hash::check($request->old_password, $oldPasswordCheck)) {
            return redirect()->back()->with("old_password", "Old Password Doesn't match!");
        }

        $this->changePassword($request);

        return redirect()->back()->with("sess_password", "Password changed successfully!");
    }

    public function changePassword($request)
    {
        $role = $request->role;
        $newPassword  = Hash::make($request->new_password);

        $data = [
            'password' => $newPassword
        ];

        if ($role == "web") {
            $update = User::where('id', $request->userId)->update($data);
        } elseif ($role == "mitra") {
            $update = MstMitra::where('id', $request->userId)->update($data);
        } else {
            abort(500);
        }

        return $update;
    }
}
