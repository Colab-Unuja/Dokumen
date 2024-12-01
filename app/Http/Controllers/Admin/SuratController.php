<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('v_surat')->get();
            return datatables()::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_template_surat;
                })
                ->make(true);
        }
        return view('admin.surat.index');
    }

    public function create()
    {
        $unit = DB::table('v_unit')->get();

        return view('admin.surat.create',compact('unit'));
    }

    public function store(Request $request)
    {
        $save = $request->all();
        unset($save['_token']);
        unset($save['_method']);
        $result = [];
        if (isset($request->key, $request->value)) {
            $keys = $request->key;
            $values = $request->value;
            foreach ($keys as $index => $key) {
                $result[] = [
                    'key' => $key,
                    'value' => $values[$index] ?? null,
                ];
            }
        }
        $extension = $request->file('file')->getClientOriginalExtension();
        if ($extension == 'doc' || $extension == 'docx') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = static::quickRandom(12) . '.' . $extension;
            $request->file('file')->move('berkas/surat', $fileName);
            $save['file'] = $fileName;
        }
        unset($save['key']);
        unset($save['value']);

        $save['variabel'] = $result;
        return $save;
    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function edit_multi(Request $request)
    {

        return response()->json(['status' => 'success']);
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
