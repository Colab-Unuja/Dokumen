<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class KaryawanController extends Controller
{

    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('v_user')->where('kategori','karyawan')->orderByDesc('id_user')->get();
            return Datatables::of($all)
                ->addIndexColumn()
                ->addColumn('cek', function ($model) {
                    return $model->id_user;
                })
                ->addColumn('action', function ($model) {
                    return $model->id_user;
                })
                ->make(true);
        }
        return view('admin.karyawan.index');
    }

    public function store(Request $request)
    {
        $x = user::where('email', $request->email)->first();
        if ($x != null) {
            return Redirect()->route('user.create')->withInput()->with('error', 'Email ' . $request->email . ' sudah ada');
        }

        $messages = [
            'required' => ':required harus di isi',
            'email' => ':email ini bukan email yang benar',
            'min' => 'minimal penulisan harus di atas :min ',
            'max' => 'maxsimal penulisan harus di bawah :max '
        ];
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3|max:255',
            'email' => 'email|required|min:3|max:255',
            'password' => 'required|min:5|max:255',
        ], $messages);
        if ($validator->fails()) {
            return Redirect()->route('admin.karyawan.create')
                ->withErrors($validator)
                ->withInput();
        }
        $save = $request->all();
        $save['password'] = bcrypt($request->password);
        $save['kategori'] = 'karyawan';

        User::create($save);
        return Redirect()->route('admin.karyawan.index');
    }

    public function create()
    {
        $unit = DB::table('v_unit')->get();
        return view('admin.karyawan.create',compact('unit'));
    }

    public function show($id)
    {
        $one = DB::table('v_user')->where('kategori','karyawan')->where('id_user', $id)->orderByDesc('id_user')->get();
        return view('admin.karyawan.show', compact('one'));
    }

    public function edit($id)
    {
        $one = User::where('id_user', $id)->where('kategori','karyawan')->first();
        $unit = DB::table('v_unit')->get();

        return view('admin.karyawan.edit', compact('id', 'one','unit'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':required harus di isi',
            'email' => ':email ini bukan email yang benar',
            'min' => 'minimal penulisan harus di atas :min ',
            'max' => 'maxsimal penulisan harus di bawah :max '
        ];
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3|max:255',
            'email' => 'email|required|min:3|max:255',

        ], $messages);
        if ($validator->fails()) {
            return Redirect()->route('admin.karyawan.edit', ['karyawan' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $y = User::where('id_user', $id)->first();
        $x = User::where('email', $request->email)->first();
        if ($x != null) {
            if ($x->email != $y->email) {
                return Redirect()->route('admin.karyawan.edit', ['karyawan' => $id])->withInput()->with('error', 'Email ' . $request->email . ' sudah ada');
            }
        }
        if ($request->password != '') {
            User::find($id)->update([
                'nama' => $request->nama,
                'id_unit' => $request->id_unit,
                'kategori' => 'karyawan',
                'email' => $request->email,
                'status' => $request->status,
                'password' => bcrypt($request->password)
            ]);
        } else {
            User::find($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'status' => $request->status,
                'id_unit' => $request->id_unit,
                'kategori' => 'karyawan',
            ]);
        }
        return Redirect()->route('admin.karyawan.index');

    }

    public function destroy($id)
    {
        $x = User::where('id_user', $id)->where('kategori','karyawan')->first();
        return $x->delete();
    }

    public function edit_multi(Request $request)
    {
        foreach ($request->id_user as $row) {
            $save['status'] = $request->status;
            User::updateOrCreate(['id_user' => $row, 'kategori' => 'karyawan'], $save);
        }
        return response()->json(['status' => 'success']);
    }
}
