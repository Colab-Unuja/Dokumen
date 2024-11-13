<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('v_unit')->orderByDesc('id_unit')->get();
            return datatables()::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_unit;
                })
                ->make(true);
        }
        return view('admin.unit.index');
    }
    public function create()
    {
        $query1 = DB::table('master_fakultas')
            ->select('id_fakultas as kode', DB::raw("'fakultas' as status"))
            ->where('status', 'active');

        $query2 = DB::table('master_prodi')
            ->select('id_prodi as kode', DB::raw("'prodi' as status"))
            ->where('status', 'active');

        $query3 = DB::table('master_lembaga')
            ->select('id_lembaga as kode', DB::raw("'lembaga' as status"))
            ->where('status', 'active');

        $result = $query1->unionAll($query2)
            ->unionAll($query3)
            ->get();

        $data = $result->map(function ($item) {
            return (array) $item;
        })->toArray();

        DB::table('master_unit')->upsert($data, ['kode'], ['status']);
    }
}
