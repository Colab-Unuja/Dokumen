<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class DosenController extends Controller
{

    public function index(Request $req)
    {

        if ($req->ajax()) {
            $all = DB::table('v_user')->where('kategori','dosen')->orderByDesc('id_user')->get();
            return Datatables::of($all)->make(true);
        }
        return view('admin.dosen.index');
    }
}