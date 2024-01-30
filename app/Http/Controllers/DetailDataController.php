<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class DetailDataController extends Controller
{
    public function index_panel()
    {
        return view('componentsAdmin.DetailData.panel');
    }


    public function cari_panel(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_idpel')
                ->where('idpelname', 'LIKE', "%$cari%")
                ->orWhere('idpel', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function panel_get_det(Request $request)
    {
        $data = DB::table('tb_lampu')
            ->where('tb_lampu.idpel_id', $request->id)
            ->leftjoin('tb_idpel', 'tb_lampu.idpel_id', '=', 'tb_idpel.id_idpel')
            ->leftjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_lampu.kecamatan_id')
            ->leftjoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_lampu.desa_id')
            ->leftjoin('tb_type', 'tb_type.id_type', '=', 'tb_lampu.type_id')
            ->leftjoin('tb_merk', 'tb_merk.id_merk', '=', 'tb_lampu.merk_id')
            ->orderby('tb_lampu.kodeID', 'asc')
            ->select('tb_lampu.*', 'tb_kecamatan.nama_kecamatan', 'tb_desa.nama_desa', 'tb_type.type', 'tb_merk.merk', 'tb_idpel.idpel')
            ->get();

        // return response()->json($data);
        return Datatables::of($data)->make();
    }

    public function index_desa()
    {
        return view('componentsAdmin.DetailData.desa');
    }


    public function cari_desa(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_desa')
                ->where('nama_desa', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function desa_get_det(Request $request)
    {
        $data = DB::table('tb_lampu')
            ->where('tb_lampu.desa_id', $request->id)
            ->leftjoin('tb_idpel', 'tb_lampu.idpel_id', '=', 'tb_idpel.id_idpel')
            ->leftjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_lampu.kecamatan_id')
            ->leftjoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_lampu.desa_id')
            ->leftjoin('tb_type', 'tb_type.id_type', '=', 'tb_lampu.type_id')
            ->leftjoin('tb_merk', 'tb_merk.id_merk', '=', 'tb_lampu.merk_id')
            ->orderby('tb_idpel.kodeID', 'asc')
            ->select('tb_lampu.*', 'tb_kecamatan.nama_kecamatan', 'tb_desa.nama_desa', 'tb_type.type', 'tb_merk.merk', 'tb_idpel.idpel')
            ->get();

        // return response()->json($data);
        return Datatables::of($data)->make();
    }


    public function index_camat()
    {
        return view('componentsAdmin.DetailData.kecamatan');
    }


    public function cari_camat(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_kecamatan')
                ->where('nama_kecamatan', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function camat_get_det(Request $request)
    {
        $data = DB::table('tb_lampu')
            ->where('tb_lampu.kecamatan_id', $request->id)
            ->leftjoin('tb_idpel', 'tb_lampu.idpel_id', '=', 'tb_idpel.id_idpel')
            ->leftjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_lampu.kecamatan_id')
            ->leftjoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_lampu.desa_id')
            ->leftjoin('tb_type', 'tb_type.id_type', '=', 'tb_lampu.type_id')
            ->leftjoin('tb_merk', 'tb_merk.id_merk', '=', 'tb_lampu.merk_id')
            ->orderby('tb_desa.nama_desa', 'asc')
            ->select('tb_lampu.*', 'tb_kecamatan.nama_kecamatan', 'tb_desa.nama_desa', 'tb_type.type', 'tb_merk.merk', 'tb_idpel.idpel')
            ->get();

        // return response()->json($data);
        return Datatables::of($data)->make();
    }
}
