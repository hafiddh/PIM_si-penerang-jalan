<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class KomponenController extends Controller
{
    public function show_merk()
    {
        $merk = DB::table('tb_merk')->orderBy('id_merk', 'asc')->get();
        return view('componentsAdmin/Komponen/merk', ['merk' => $merk]);
    }
    public function store_merk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required'
        ]);
        $merk = ucfirst($request->merk);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_merk')->insert(['merk' => $merk, 'created_at' => $date]);
        return back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function update_merk(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required'
        ]);
        $name = ucfirst($request->merk);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_merk')->where('id_merk', $id)->update(['merk' => $name, 'updated_at' => $date]);
        return back()->with('success', 'Data berhasil diubah.');
    }
    public function destroy_merk($id)
    {
        DB::table('tb_merk')->where('id_merk', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    // Type Lampu

    public function show_type()
    {
        $type = DB::table('tb_type')->orderBy('id_type', 'asc')->get();
        return view('componentsAdmin/Komponen/type', ['type' => $type]);
    }
    public function store_type(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);
        $type = ucfirst($request->type);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_type')->insert(['type' => $type, 'created_at' => $date]);
        return back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function update_type(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);
        $name = ucfirst($request->type);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_type')->where('id_type', $id)->update(['type' => $name, 'updated_at' => $date]);
        return back()->with('success', 'Data berhasil diubah.');
    }
    public function destroy_type($id)
    {
        DB::table('tb_type')->where('id_type', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    // Tarif Lampu

    public function show_tarif()
    {
        $tarif = DB::table('tb_tarif')->orderBy('id_tarif', 'asc')->get();
        return view('componentsAdmin/Komponen/tarif', ['tarif' => $tarif]);
    }
    public function store_tarif(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tarif' => 'required'
        ]);
        $tarif = ucfirst($request->tarif);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_tarif')->insert(['tarif' => $tarif, 'created_at' => $date]);
        return back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function update_tarif(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tarif' => 'required'
        ]);
        $name = ucfirst($request->tarif);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_tarif')->where('id_tarif', $id)->update(['tarif' => $name, 'updated_at' => $date]);
        return back()->with('success', 'Data berhasil diubah.');
    }
    public function destroy_tarif($id)
    {
        DB::table('tb_tarif')->where('id_tarif', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    // Tarif IDPEL

    public function show_idpel()
    {
        $idpel = DB::table('tb_idpel')
            ->leftjoin('tb_desa', 'tb_desa.id_desa', 'tb_idpel.id_desa')
            ->orderBy('tb_idpel.id_idpel', 'asc')
            ->select('tb_idpel.*', 'tb_desa.nama_desa')
            ->get();

        $desa = DB::table('tb_desa')->get();
        return view('componentsAdmin.Komponen.idpel', [
            'idpel' => $idpel,
            'desa' => $desa
        ]);
    }
    public function store_idpel(Request $request)
    {
        // ddd($request->all());
        $validator = Validator::make($request->all(), [
            'idpel' => 'required',
            'idpelname' => 'required',
            'tarif' => 'required',
            'daya' => 'required',
            'kogol' => 'required'
        ]);
        $kodeID = DB::table('tb_idpel')->select('kodeID')->orderBy('id_idpel', 'desc')->first();
        $uniqID = @$kodeID->kodeID;

        if ($uniqID == null) {
            $table_no = '000';
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (3 - strlen($auto))) . $auto;
        } else {
            $table_no = $uniqID;
            $auto = intval($table_no) + 1;
            $auto_number = str_repeat(0, (3 - strlen($auto))) . $auto;
        }

        $date = date('Y-m-d:h:m:i');
        DB::table('tb_idpel')->insert([
            'idpel' => $request->idpel,
            'kodeID' => $auto_number,
            'idpelname' => $request->idpelname,
            'tarif' => $request->tarif,
            'daya' => $request->daya,
            'kogol' => $request->kogol,
            'id_desa' => $request->desa,
            'created_at' => $date
        ]);
        return back()->with('success', 'Data berhasil ditambahkan.');
    }
    public function update_idpel(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'idpel' => 'required',
            'idpelname' => 'required',
            'tarif' => 'required',
            'daya' => 'required',
            'kogol' => 'required'
        ]);
        $date = date('Y-m-d:h:m:i');
        DB::table('tb_idpel')->where('id_idpel', $id)->update([
            'idpel' => $request->idpel,
            'idpelname' => $request->idpelname,
            'tarif' => $request->tarif,
            'daya' => $request->daya,
            'kogol' => $request->kogol,
            'id_desa' => $request->desa,
            'updated_at' => $date
        ]);
        return back()->with('success', 'Data berhasil diubah.');
    }
    public function destroy_idpel($id)
    {
        DB::table('tb_idpel')->where('id_idpel', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
