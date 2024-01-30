<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class StreetLightController extends Controller
{
    public function show_light()
    {
        $light = DB::table('tb_lampu')->select('tb_lampu.*', 'tb_kecamatan.nama_kecamatan', 'tb_desa.nama_desa', 'tb_merk.merk', 'tb_type.type', 'tb_idpel.idpel')
            ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_lampu.kecamatan_id')
            ->leftJoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_lampu.desa_id')
            ->leftJoin('tb_type', 'tb_type.id_type', '=', 'tb_lampu.type_id')
            ->leftJoin('tb_merk', 'tb_merk.id_merk', '=', 'tb_lampu.merk_id')
            ->leftJoin('tb_idpel', 'tb_idpel.id_idpel', '=', 'tb_lampu.idpel_id')
            ->orderBy('id_lampu', 'asc')
            ->get();
        return view('componentsAdmin.StreetLight.show', ['light' => $light]);
    }
    public function store_light()
    {
        $kec = DB::table('tb_kecamatan')->orderBy('id_kecamatan', 'asc')->get();
        $merk = DB::table('tb_merk')->orderBy('id_merk', 'asc')->get();
        $idpel = DB::table('tb_idpel')->orderBy('id_idpel', 'asc')->get();
        $type = DB::table('tb_type')->orderBy('id_type', 'asc')->get();
        $data = array(
            'kecamatan' => $kec, 'merk' => $merk, 'idpel' => $idpel, 'type' => $type
        );
        return view('componentsAdmin.StreetLight.create', $data);
    }
    public function get_desa(Request $request)
    {
        $data = DB::table('tb_desa')
            ->where('kecamatan_id', '=', $request->id)
            ->get();
        return response()->json($data);
    }
    public function get_panel(Request $request)
    {
        $data = DB::table('tb_idpel')
            ->where('tb_idpel.id_idpel', '=', $request->id)
            ->leftJoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_idpel.id_desa')
            ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_desa.kecamatan_id')
            ->select('tb_idpel.*', 'tb_kecamatan.nama_kecamatan', 'tb_desa.nama_desa')
            ->first();

        return response()->json($data);
    }
    public function add_light(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'idpel' => 'required',
            'type' => 'required',
            'merk' => 'required',
            'daya' => 'required',
            'tahun' => 'required',
        ]);

        $desa2 = DB::table('tb_idpel')->where('id_idpel', $request->idpel)->first();
        $desa = $desa2->id_desa;
        $idpel = $request->idpel;

        $kecamatan2 = DB::table('tb_desa')
            ->where('id_desa', $desa)
            ->leftjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', 'tb_desa.kecamatan_id')
            ->select('tb_desa.*', 'tb_kecamatan.id_kecamatan')
            ->first();
        $kecamatan = $kecamatan2->id_kecamatan;

        $kodeDesa = DB::table('tb_desa')->select('kodeID')->where('id_desa', $desa)->first();
        $uniqueDesa = $kodeDesa->kodeID;

        $kodePanel = DB::table('tb_idpel')->select('kodeID')->where('id_idpel', $idpel)->first();
        $uniqueIdpel = $kodePanel->kodeID;

        $kodeLight = DB::table('tb_lampu')->select('kodeID')
            ->where('desa_id', $desa)
            ->where('idpel_id', $idpel)
            ->orderBy('id_lampu', 'desc')->first();
        $uniqueLight = @$kodeLight->kodeID;

        if ($uniqueLight == null) {
            $table_no = $uniqueDesa . $uniqueIdpel . '000';
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (11 - strlen($auto))) . $auto;
        } else {
            $table_no = $uniqueLight;
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (11 - strlen($auto))) . $auto;
        }
        $date = date('Y-m-d:h:m:i');

        DB::table('tb_lampu')->insert([
            'kodeID' => $auto_number, 'kecamatan_id' => $kecamatan, 'desa_id' => $desa,
            'type_id' => $request->type, 'merk_id' => $request->merk, 'daya' => $request->daya,
            'idpel_id' => $idpel, 'created_at' => $date, 'tahun' => $request->tahun
        ]);
        return redirect('/lampu-jalan')->with('success', 'Data berhasil ditambahkan.');
    }
    public function show_update_light($id)
    {
        $light = DB::table('tb_lampu')->select('tb_lampu.*', 'tb_kecamatan.nama_kecamatan', 'tb_kecamatan.id_kecamatan', 'tb_desa.nama_desa', 'tb_desa.id_desa', 'tb_merk.merk', 'tb_merk.id_merk', 'tb_type.type', 'tb_type.id_type', 'tb_idpel.idpel', 'tb_idpel.id_idpel', 'tb_idpel.idpelname')
            ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_lampu.kecamatan_id')
            ->leftJoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_lampu.desa_id')
            ->leftJoin('tb_type', 'tb_type.id_type', '=', 'tb_lampu.type_id')
            ->leftJoin('tb_merk', 'tb_merk.id_merk', '=', 'tb_lampu.merk_id')
            ->leftJoin('tb_idpel', 'tb_idpel.id_idpel', '=', 'tb_lampu.idpel_id')
            ->where('id_lampu', $id)
            ->first();
        $kec = DB::table('tb_kecamatan')->orderBy('id_kecamatan', 'asc')->get();
        $merk = DB::table('tb_merk')->orderBy('id_merk', 'asc')->get();
        $idpel = DB::table('tb_idpel')->orderBy('id_idpel', 'asc')->get();
        $type = DB::table('tb_type')->orderBy('id_type', 'asc')->get();
        $data = array(
            'kecamatan' => $kec,
            'merk' => $merk,
            'idpel' => $idpel,
            'type' => $type,
            'light' => $light
        );
        return view('componentsAdmin.StreetLight.update', $data);
    }
    public function update_light(Request $request, $id)
    {
        // dd($request->all(), $id);
        $validator = Validator::make($request->all(), [
            'idpel' => 'required',
            'type' => 'required',
            'merk' => 'required',
            'daya' => 'required',
            'tahun' => 'required',
        ]);

        $date = date('Y-m-d:h:m:i');
        $getData = DB::table('tb_lampu')->where('id_lampu', $id)->first();
        $IDdesa = $getData->desa_id;
        $IDpanel = $getData->idpel_id;

        $desa2 = DB::table('tb_idpel')->where('id_idpel', $request->idpel)->first();
        $desa = $desa2->id_desa;
        $idpel = $request->idpel;

        $kecamatan2 = DB::table('tb_desa')
            ->where('id_desa', $desa)
            ->leftjoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', 'tb_desa.kecamatan_id')
            ->select('tb_desa.*', 'tb_kecamatan.id_kecamatan')
            ->first();
        $kecamatan = $kecamatan2->id_kecamatan;


        $kodeDesa = DB::table('tb_desa')->select('kodeID')->where('id_desa', $desa)->first();
        $uniqueDesa = $kodeDesa->kodeID;

        $kodePanel = DB::table('tb_idpel')->select('kodeID')->where('id_idpel', $request->idpel)->first();
        $uniqueIdpel = $kodePanel->kodeID;

        $kodeLight = DB::table('tb_lampu')->select('kodeID')
            ->where('desa_id', $request->desa)
            ->where('idpel_id', $request->idpel)
            ->orderBy('id_lampu', 'desc')->first();
        $uniqueLight = @$kodeLight->kodeID;

        if ($uniqueLight == null) {
            $table_no = $uniqueDesa . $uniqueIdpel . '000';
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (11 - strlen($auto))) . $auto;
        } else {
            $table_no = $uniqueLight;
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (11 - strlen($auto))) . $auto;
        }

        DB::table('tb_lampu')->where('id_lampu', $id)->update([
            'kodeID' => $auto_number, 'kecamatan_id' => $kecamatan, 'desa_id' => $desa,
            'type_id' => $request->type, 'merk_id' => $request->merk, 'daya' => $request->daya,
            'idpel_id' => $request->idpel, 'updated_at' => $date, 'tahun' => $request->tahun
        ]);

        return redirect('/lampu-jalan')->with('success', 'Data berhasil diubah.');
    }
    public function delete_light($id)
    {
        DB::table('tb_lampu')->where('id_lampu', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
