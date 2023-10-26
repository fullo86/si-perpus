<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('v_member/members', ['listMembers' => $data]);
    }

    public function show($slug)
    {
        $showData = User::where('slug', $slug)->first();
        $rentlogs = Activity::with(['user', 'book'])->where('user_id', $showData->id)->get();

        return view('v_member/show', ['showMember' => $showData, 'listData' => $rentlogs]);
    }

    public function edit($slug)
    {
        $dataMembers = User::where('slug', $slug)->first();
        return view('v_member/edit', ['memberValue' => $dataMembers]);
    }

    public function update(Request $request, $slug)
    {
        $user = Auth::user();
        $updateUser = User::where('slug', $slug)->first();
        $data = $request->all();
    
        if ($request->file('image_user')) {
            // Menghapus gambar lama jika ada
            if ($updateUser->image_user != 'default.png' && file_exists(public_path('storage/images/' . $updateUser->image_user))) {
                unlink(public_path('storage/images/' . $updateUser->image_user));
            }
    
            // Mengunggah gambar yang baru
            $extension = $request->file('image_user')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image_user')->storeAs('public/images/', $newName);
    
            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_user'] = $newName;
        }
    
        $updateUser->update($data);
    
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data User');
        if ($user && $user->id != 1) {
            return redirect('/dashboards');
        }
        return redirect('/members');
    }

    public function approve(Request $request, $slug)
    {
        $member = User::where('slug', $slug)->first();

        if ($member->status != 'active') {
            $member->status = 'active';
            $member->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Status Anggota Diaktifkan');
            return redirect('/members');
        }else{
            $member->status = 'inactive';
            $member->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Status Anggota Dinonaktifkan');
            return redirect('/members');          
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Status Anggota Gagal Diaktifkan');
        return redirect('/members');
    }

    public function destroy($slug)
    {
        $removeMember = User::where('slug', $slug)->first();

        if ($removeMember->image_user) {
            if ($removeMember->image_user != 'default.png' && file_exists(public_path('storage/images/' . $removeMember->image_user))) {
                unlink(public_path('storage/images/' . $removeMember->image_user));
            }
        }

        if (!$removeMember) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Anggota');
        }

        $removeMember->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Anggota');
        return redirect('/members');
    }

    public function profile()
    {
        $user = Auth::user();
        $logsData = Activity::where('user_id', $user->id)->get();
        $dataMember = User::where('id', 'id')->get();
        $countRent = $logsData->where('actual_return_date', null)->count();
        $countReturnBook = $logsData->where('actual_return_date', '!=', null)->count();
        $rentlogs = Activity::with(['user', 'book'])->where('user_id', $user->id)->get();

        // dd($dataMember);
        return view('v_member/dashboard', ['currentLoginMember' => $dataMember, 'countBookRent' => $countRent, 'countReturnBook' => $countReturnBook, 'listData' => $rentlogs]);
    }
}
