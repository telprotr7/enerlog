<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function index()
    {
        $members = User::all();

        return view('members.index', [
            'title' => 'Members List',
            'members' => $members
        ]);
    }

    public function addMember(Request $request)
    {

        


        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:2',
            'nik' => 'required|digits:8|numeric|unique:users',
            'password' => 'required|min:3'
        ]);

        $validator->sometimes('email', 'email', function ($input) {
            return $input->email !== null;
        });

        $validator->sometimes('image', 'image|file|max:1024', function ($input) {
            return $input->image !== null;
        });

        if ($validator->fails()) {
            return redirect('/members')
                ->withErrors($validator)
                ->withInput()
            ->with('error', 'Member gagal  ditambahkan!');
        }

        if ($request->status > 0) {

            $validateData['is_active'] = $request->status;
        } else {

            $validateData['is_active'] = 0;
        }
        if ($request->role > 0) {
            $validateData['role'] = $request->role;
        } else {
            $validateData['role'] = 0;
        }

        if ($request->image == null) {
            $validateData['image'] = 'default.png';
        } else {

            $validateData['image'] = $request->file('image')->store('user-images');
        }



        $validateData['password'] = bcrypt($request->password);
        $validateData['name'] = $request->nama;
        $validateData['no_wa'] = $request->no_wa;
        $validateData['tanggal_lahir'] = $request->tanggal_lahir;
        $validateData['tampat_lahir'] = $request->tampat_lahir;
        $validateData['nik'] = $request->nik;
        $validateData['email'] = $request->email;

        User::create($validateData);
        return redirect('/members')->with('success', $request->nama . ' berhasil ditambahkan!');
    }


    public function updateMember(Request $request, $id)
    {
        if ($request->status > 0 || $request->role > 0) {
            $data['is_active'] = $request->status;
            $data['role'] = $request->role;
        } else {
            $data['is_active'] = 0;
            $data['role'] = 0;
        }        

        User::where('id', $id)->update($data);
        return redirect('/members')->with('success', 'Data member berhasil diupdate!' );
    }


    public function destroyMember(string $id)
    {
        User::destroy($id);
        return response()->json(['success', 'User has been delete!']);
    }

    public function detailsMember($id)
    {
        $memberdetail = User::find($id);
        return view('members.detail-member', [
            'title' => 'Data Member',
            'member' => $memberdetail
        ]);
    }
}
