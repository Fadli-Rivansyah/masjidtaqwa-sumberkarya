<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return view('admin.setting.index', [
            'title' => 'Setting',
            'dataUser' => $user
        ]);
    }
    public function editProfile()
    {
        $user = User::find(1);
        return view('admin.setting.profile',[
            'title' => 'setting profile',
            'dataUser' => $user
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = User::find(1);
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'email|required'
        ],[
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required' => 'Email harus diisi',
        ]);
        $data = [
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
        ];
        User::where('id', $user->id)->update($data);
        return redirect('/admin/setting/profile')->with('success', 'Profile berhasil diubah');
    }
    public function editpassword()
    {
        $user = User::find(1);
        return view('admin.setting.password',[
            'title' => 'setting password',
            'dataUser' => $user
        ]);
    }
    public function updatePassword(Request $request)
    {
        $user = User::find(1);
        $validated = $request->validate([
            'passwordL' => 'required',
            'passwordB' => 'required',
        ],[
            'passwordL' => 'password tidak cocok',
            'passwordB' => 'password harus diisi',
        ]);
        if(Hash::check($request->passwordL, $user->password)){
            $user->update([
                'password' => Hash::make($validated['passwordB'])
            ]);
            return redirect('/admin/setting/password')->with('success', 'password berhasil diubah');
        }else{
            return redirect()->back()->withErrors(['passwordL' => 'password tidak cocok']);
        }
    }
}
