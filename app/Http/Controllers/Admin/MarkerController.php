<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkerController extends Controller
{
    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('master_marker')->orderByDesc('id_marker')->get();
            return datatables()::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_marker;
                })
                ->make(true);
        }
        return view('admin.marker.index');
    }
    public function create()
    {
        return view('admin.marker.create');
    }

    public function store(Request $request)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_marker')->insert($save);
        return redirect()->route('admin.marker.index');
    }

    public function show($id)
    {
        $one = DB::table('master_marker')->where('id_marker',$id)->first();
        return view('admin.marker.show',compact('one'));
    }

    public function edit($id)
    {
        $one = DB::table('master_marker')->where('id_marker',$id)->first();
        return view('admin.marker.edit',compact('one','id'));
    }
    public function update(Request $request, $id)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        DB::table('master_marker')->where('id_marker',$id)->update($save);
        return redirect()->route('admin.marker.index');
    }

    public function destroy($id)
    {
        return DB::table('master_marker')->where('id_marker',$id)->delete();
    }
    public function edit_multi(Request $request)
    {
        foreach ($request->id_user as $row) {
            $save['status'] = $request->status;
            DB::table('master_marker')->where('id_marker',$row)->update($save);
        }
        return response()->json(['status' => 'success']);
    }
}
