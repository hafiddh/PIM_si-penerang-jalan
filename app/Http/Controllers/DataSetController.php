<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use Validator;
use DB;
use Carbon;

class DataSetController extends Controller
{
    public function location()
    {
        $location = DB::table('tb_kecamatan')->orderBy('id_kecamatan', 'asc')->get();
        $get = array();
        for ($i = 0; $i < count($location); $i++) {
            $get[$i] = $location[$i];
            $get[$i]->desa = DB::table('tb_desa')->where('kecamatan_id', $location[$i]->id_kecamatan)->count();
        }
        return view('componentsAdmin.DataSet.location', ['location' => $get]);
    }
    public function location_desa($name)
    {
        $location = DB::table('tb_desa')
            ->select('tb_desa.*', 'tb_kecamatan.nama_kecamatan', 'tb_kecamatan.id_kecamatan')
            ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_desa.kecamatan_id')
            ->where('nama_kecamatan', $name)->orderBy('id_desa', 'asc')->get();
        return view('componentsAdmin.DataSet.location-desa', ['location' => $location]);
    }

    public function store_desa(LocationRequest $request)
    {
        $date = date('Y-m-d:h:m:i');
        $desa = ucfirst($request->desa);
        $idkec = DB::table('tb_kecamatan')->select('kode')->where('id_kecamatan', $request->kecamatan)->first();
        $uniq_kec = $idkec->kode;

        $kodeIDdesa = DB::table('tb_desa')->select('kodeID')->where('kecamatan_id', $request->kecamatan)->orderBy('id_desa', 'desc')->first();
        $uniq_desa = @$kodeIDdesa->kodeID;

        if ($uniq_desa == null) {
            $table_no = $uniq_kec . '000';
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (5 - strlen($auto))) . $auto;
        } else {
            $table_no = $uniq_desa;
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (5 - strlen($auto))) . $auto;
        }

        // echo "<pre>";
        // print_r($auto_number);
        // echo "</pre>";
        DB::table('tb_desa')->insert([
            'kecamatan_id' => $request->kecamatan, 'kodeID' => $auto_number, 'nama_desa' => $desa, 'created_at' => $date, 'updated_at' => $date
        ]);
        return back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function location_update(Request $request, $name)
    {
        $validator = Validator::make($request->all(), [
            'kecamatan' => 'required'
        ]);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_kecamatan')->where('nama_kecamatan', $name)->update([
            'nama_kecamatan' => $request->kecamatan, 'updated_at' => $date
        ]);
        return back()->with('success', 'Data berhasil diubah.');
    }
    public function location_desa_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'desa' => 'required'
        ]);
        $desa = ucfirst($request->desa);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_desa')->where('id_desa', $id)->update([
            'nama_desa' => $desa, 'updated_at' => $date
        ]);
        return back()->with('success', 'Data berhasil diubah.');
    }
    public function destroy_desa($nama)
    {
        DB::table('tb_desa')->where('nama_desa', $nama)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
