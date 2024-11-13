<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LembagaController extends Controller
{
    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('master_lembaga')->orderByDesc('id_lembaga')->get();
            return datatables()::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_lembaga;
                })
                ->make(true);
        }
        return view('admin.lembaga.index');
    }
    public function create()
    {
        return view('admin.lembaga.create');
    }

    public function store(Request $request)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_lembaga')->insert($save);
        return redirect()->route('admin.lembaga.index');
    }

    public function show($id)
    {
        $one = DB::table('master_lembaga')->where('id_lembaga',$id)->first();
        return view('admin.lembaga.show',compact('one'));
    }

    public function edit($id)
    {
        $one = DB::table('master_lembaga')->where('id_lembaga',$id)->first();
        return view('admin.lembaga.edit',compact('one','id'));
    }
    public function update(Request $request, $id)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_lembaga')->where('id_lembaga',$id)->update($save);
        return redirect()->route('admin.lembaga.index');
    }

    public function destroy($id)
    {
        return DB::table('master_lembaga')->where('id_lembaga',$id)->delete();
    }
}
