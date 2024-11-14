<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('master_prodi')->select('master_prodi.*','master_fakultas.fakultas')->leftJoin('master_fakultas','master_fakultas.id_fakultas','=','master_prodi.id_fakultas')->orderByDesc('master_prodi.id_prodi')->get();
            return datatables()::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_prodi;
                })
                ->make(true);
        }
        return view('admin.prodi.index');
    }
    public function create()
    {
        $fakultas = DB::table('master_fakultas')->where('status','active')->get();
        return view('admin.prodi.create',compact('fakultas'));
    }

    public function store(Request $request)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_prodi')->insert($save);
        return redirect()->route('admin.prodi.index');
    }

    public function show($id)
    {
        $one = DB::table('master_prodi')->select('master_prodi.*','master_fakultas.fakultas')->where('master_prodi.id_prodi',$id)->first();
        return view('admin.prodi.show',compact('one'));
    }

    public function edit($id)
    {
        $fakultas = DB::table('master_fakultas')->where('status','active')->get();
        $one = DB::table('master_prodi')->where('id_prodi',$id)->first();
        return view('admin.prodi.edit',compact('one','id','fakultas'));
    }
    public function update(Request $request, $id)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_prodi')->where('id_prodi',$id)->update($save);
        return redirect()->route('admin.prodi.index');
    }

    public function destroy($id)
    {
        return DB::table('master_prodi')->where('id_prodi',$id)->delete();
    }
}
