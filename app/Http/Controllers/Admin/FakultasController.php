<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakultasController extends Controller
{
    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('master_fakultas')->orderByDesc('id_fakultas')->get();
            return datatables()::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_fakultas;
                })
                ->make(true);
        }
        return view('admin.fakultas.index');
    }
    public function create()
    {
        return view('admin.fakultas.create');
    }

    public function store(Request $request)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_fakultas')->insert($save);
        return redirect()->route('admin.fakultas.index');
    }

    public function show($id)
    {
        $one = DB::table('master_fakultas')->where('id_fakultas',$id)->first();
        return view('admin.fakultas.show',compact('one'));
    }

    public function edit($id)
    {
        $one = DB::table('master_fakultas')->where('id_fakultas',$id)->first();
        return view('admin.fakultas.edit',compact('one','id'));
    }
    public function update(Request $request, $id)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_fakultas')->where('id_fakultas',$id)->update($save);
        return redirect()->route('admin.fakultas.index');
    }

    public function destroy($id)
    {
        return DB::table('master_fakultas')->where('id_fakultas',$id)->delete();
    }
}
