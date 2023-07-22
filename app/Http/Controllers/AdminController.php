<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Databuku;
use App\Models\DataAnggota;
use App\Models\DataPengunjung;
use App\Models\PpMandiri;


class AdminController extends Controller
{
    /*beranda*/
    public function Beranda()
    {
       $total_buku= DataBuku::get()->count();
    //  dd($total_buku);

        return view('beranda', compact('total_buku'));
    }

    /*data buku*/
    public function DataBuku()
    {
       $data_buku = DataBuku::all();
        return view('data-buku',['databukus'=>$data_buku]);
    }
    /*create*/
    public function TambahDataBuku(Request $request)
    {
        $data_buku = Databuku::create($request->all());
        // dd($request->all);
        return redirect()->route('data-buku');
    }
    /*update*/
    public function UpdateDataBuku (Request $request, $id) {
        $data_buku = DataBuku::find($id);
        $data_buku -> update($request->all());
        return redirect()->route('data-buku');
    }
    /*delete*/
    public function DeleteDataBuku($id){
        $data_databuku = DataBuku::find($id);
        $data_databuku -> delete();
        return redirect()->route('data-buku');
    }


    /*data anggota*/
   
    public function DataAnggota()
    {
        $data_anggota = DataAnggota::all();
        return view('data-anggota',['dataanggota'=>$data_anggota]);
    }
    /*create*/
    public function TambahDataAnggota(Request $request)
    {
        $data_anggota = DataAnggota::create($request->all());
        // dd($request->all);
        return redirect()->route('data-anggota');
    }
    /*update*/
    public function UpdateDataAnggota (Request $request, $id) {
        $data_anggota = DataAnggota::find($id);
        $data_anggota -> update($request->all());
        return redirect()->route('data-anggota');
    }
    /*delete*/
    public function DeleteDataAnggota($id){
        $data_dataanggota = DataAnggota::find($id);
        $data_dataanggota-> delete();
        return redirect()->route('data-anggota');
    }


    /*data pengunjung*/
    public function DataPengunjung()
    {
        $data_pengunjung = DataPengunjung::all();
        return view('data-pengunjung',['datapengunjung'=>$data_pengunjung]);
    }
    /*create*/
    public function TambahDataPengunjung(Request $request)
    {
        $data_pengunjung = DataPengunjung::create($request->all());
        // dd($request->all);
        return redirect()->route('data-pengunjung');
    }
    /*update*/
    public function UpdateDataPengunjung (Request $request, $id) {
        $data_pengunjung = DataPengunjung::find($id);
        $data_pengunjung -> update($request->all());
        return redirect()->route('data-pengunjung');
    }
    /*delete*/
    public function DeleteDataPengunjung($id){
        $data_pengunjung = DataPengunjung::find($id);
        $data_pengunjung-> delete();
        return redirect()->route('data-pengunjung');
    }


    public function PeminjamandanPengembalianMandiri()
    {
        $judul_buku = Databuku::get();
        // dd($judul_buku);
        $pp_mandiri = PpMandiri::all();
        
        return view('peminjamandanpengembalian-mandiri',compact('judul_buku','pp_mandiri'));
    }

        /*create*/
        public function TambahPeminjamanMandiri(Request $request)
        {
            $pinjam_mandiri = PpMandiri::create($request->all());
            // dd($request->all);
            return redirect()->route('pinjam-mandiri');
        }

         /*update*/
    public function UpdatePeminjamanMandiri (Request $request, $id) {
        $update_pp_mandiri = PpMandiri::find($id);
        $update_pp_mandiri -> update($request->all());
        return redirect()->route('pinjam-mandiri');
    }

    public function PeminjamandanPengembalianKolektif()
    {
        return view('peminjamandanpengembalian-kolektif');
    }


    public function Laporan()
    {
        return view('laporan');
    }
}
