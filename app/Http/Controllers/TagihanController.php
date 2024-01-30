<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use DataTables;

class TagihanController extends Controller
{
    public function index_tagihan()
    {
        $data = DB::table('tb_idpel')->get();
        $data_kwh = DB::table('tb_tarif')->get();
        return view('componentsAdmin.Tagihan.tagihan', [
            'data' => $data,
            'data2' => $data,
            'data_kwh' => $data_kwh,
        ]);
    }

    public function tambah_tagihan(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'idpel' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
        ]);

        if ($request->jenis == '1') {

            $tagihan = $request->jam_nyala * $request->tarif * ($request->total_daya) / 1000;

            DB::table('tb_tagihan')->insert([
                'jenis' => $request->jenis,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'idpanel' => $request->idpel,
                'total_daya' => $request->total_daya,
                'jam_nyala' => $request->jam_nyala,
                'realisasi_pln' => $request->realisasi_tagihan,
                'tarif_kwh' => $request->tarif,
                'tagihan' => $tagihan,
            ]);
        } else if ($request->jenis == '2') {

            $tagihan = ($request->daya_akhir - $request->daya_awal) * $request->tarif;

            DB::table('tb_tagihan')->insert([
                'jenis' => $request->jenis,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'idpanel' => $request->idpel,
                'daya_awal' => $request->daya_awal,
                'daya_akhir' => $request->daya_akhir,
                'tarif_kwh' => $request->tarif,
                'tagihan' => $tagihan,
            ]);
        }

        return back()->with('success', 'Data berhasil ditambahkan.');
    }


    public function get_panel_daya(Request $request)
    {
        $data = DB::table('tb_idpel')
            ->where('tb_idpel.id_idpel', '=', $request->id)
            ->leftJoin('tb_desa', 'tb_desa.id_desa', '=', 'tb_idpel.id_desa')
            ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_desa.kecamatan_id')
            ->select('tb_idpel.*', 'tb_kecamatan.nama_kecamatan', 'tb_desa.nama_desa')
            ->first();

        $daya = DB::table('tb_lampu')->where('idpel_id', $data->id_idpel)->sum('daya');

        return response()->json([
            'data' => $data,
            'daya' => $daya,
        ]);
    }


    public function get_tagihan_jam(Request $request)
    {
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.jenis', '1')
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->get();

        // return response()->json($data);
        return Datatables::of($data)->make();
    }

    public function get_tagihan_daya(Request $request)
    {
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.jenis', '2')
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->get();

        // return response()->json($data);
        return Datatables::of($data)->make();
    }


    public function get_tagihan_detail(Request $request)
    {
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.id', $request->id)
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->first();

        return response()->json($data);
    }
    public function hapus_tagihan(Request $request)
    {
        DB::table('tb_tagihan')->where('id', $request->id)->delete();
        return response()->json();
    }

    // Bulan
    public function index_tagihan_bulan()
    {
        $data = DB::table('tb_idpel')->get();
        $data_kwh = DB::table('tb_tarif')->get();
        return view('componentsAdmin.Tagihan.tagihan_bulan', [
            'data' => $data,
            'data2' => $data,
            'data_kwh' => $data_kwh,
        ]);
    }


    public function cari_bulan(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_tagihan')
                ->where('jenis', '1')
                ->where('bulan', 'LIKE', "%$cari%")
                ->select('bulan', 'tahun')
                ->distinct()
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function cari_bulan_daya(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_tagihan')
                ->where('jenis', '2')
                ->where('bulan', 'LIKE', "%$cari%")
                ->select('bulan', 'tahun')
                ->distinct()
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }


    public function bulan_get_tagihan_jam(Request $request)
    {
        $tgl = explode(" ", $request->id);
        $bulan = $tgl[0];
        $tahun = $tgl[1];
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.jenis', '1')
            ->where('tb_tagihan.bulan', $bulan)
            ->where('tb_tagihan.tahun', $tahun)
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->get();

        // return response()->json([$data]);
        return Datatables::of($data)->make();
    }

    public function bulan_get_tagihan_daya(Request $request)
    {
        $tgl = explode(" ", $request->id);
        $bulan = $tgl[0];
        $tahun = $tgl[1];
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.jenis', '2')
            ->where('tb_tagihan.bulan', $bulan)
            ->where('tb_tagihan.tahun', $tahun)
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->get();

        // return response()->json($request->id);
        return Datatables::of($data)->make();
    }

    public function panel_get_tagihan_jam(Request $request)
    {
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.jenis', '1')
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->where('tb_idpel.id_idpel', $request->id)
            ->get();

        // return response()->json([$data]);
        return Datatables::of($data)->make();
    }

    public function panel_get_tagihan_daya(Request $request)
    {
        $data = DB::table('tb_tagihan')
            ->where('tb_tagihan.jenis', '2')
            ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
            ->orderby('tb_idpel.idpelname', 'asc')
            ->select('tb_tagihan.*', 'tb_idpel.idpel', 'tb_idpel.idpelname')
            ->where('tb_idpel.id_idpel', $request->id)
            ->get();


        // return response()->json($request->id);
        return Datatables::of($data)->make();
    }

    public function cari_panel_jam(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_tagihan')
                ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
                ->where('tb_tagihan.jenis', '1')
                ->distinct()
                ->where('tb_idpel.idpel', 'LIKE', "%$cari%")
                ->orwhere('tb_idpel.idpelname', 'LIKE', "%$cari%")
                ->select('tb_tagihan.idpanel', 'tb_idpel.idpel' , 'tb_idpel.idpelname')
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function cari_panel_daya(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('tb_tagihan')
                ->leftjoin('tb_idpel', 'tb_tagihan.idpanel', '=', 'tb_idpel.id_idpel')
                ->where('tb_tagihan.jenis', '2')
                ->distinct()
                ->where('tb_idpel.idpel', 'LIKE', "%$cari%")
                ->orwhere('tb_idpel.idpelname', 'LIKE', "%$cari%")
                ->select('tb_tagihan.idpanel', 'tb_idpel.idpel' , 'tb_idpel.idpelname')
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }


    public function index_tagihan_panel()
    {
        $data = DB::table('tb_idpel')->get();
        $data_kwh = DB::table('tb_tarif')->get();
        return view('componentsAdmin.Tagihan.tagihan_panel', [
            'data' => $data,
            'data2' => $data,
            'data_kwh' => $data_kwh,
        ]);
    }
}
