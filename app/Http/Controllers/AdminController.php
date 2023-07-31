<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Databuku;
use App\Models\DataAnggota;
use App\Models\DataPengunjung;
use App\Models\PpMandiri;
use App\Models\PpKolektif;
use Carbon\Carbon;

class AdminController extends Controller
{
    /*beranda*/
    public function Beranda()
    {
       $total_buku= DataBuku::get()->count();
       $total_anggota= DataAnggota::get()->count();
       $total_pengunjung= DataPengunjung::get()->count();
    //  dd($total_buku);

        return view('beranda', compact('total_buku','total_anggota','total_pengunjung'));
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


    /*PPMandiri*/
    public function PeminjamandanPengembalianMandiri()
    {
        $judul_buku = Databuku::get();
        // dd($judul_buku);
        $pp_mandiri = PpMandiri::all();
        // Hitung denda untuk setiap peminjaman
        foreach ($pp_mandiri as $pinjam_mandiri) {
            $tgl_pinjam = Carbon::parse($pinjam_mandiri->tgl_pinjam);
            $sekarang = Carbon::now();
            $selisihHari = $sekarang->diffInDays($tgl_pinjam);

            // Denda mulai dihitung setelah 3 hari sejak tanggal peminjaman
            $denda = max(0, $selisihHari - 3) * 1000;
            $pinjam_mandiri->denda = $denda;
            $pinjam_mandiri->save();
        }
        return view('peminjamandanpengembalian-mandiri',compact('judul_buku','pp_mandiri'));
    }

        /*create*/
        public function TambahPeminjamanMandiri(Request $request)
        {
            $pinjam_mandiri = PpMandiri::create($request->all());
            // dd($request->all);
            return redirect()->route('pinjam-mandiri');
        }

        // kembalikan
        public function KembalikanMandiri($id)
        {
            // Cari peminjaman berdasarkan ID
            $pinjam_mandiri = PpMandiri::findOrFail($id);

            // Ubah status menjadi "dikembalikan"
            $pinjam_mandiri->status = !$pinjam_mandiri->status;
            if ($pinjam_mandiri->status) {
                $pinjam_mandiri->tgl_kembali = Carbon::now()->toDateString();
            } else {
                $pinjam_mandiri->tgl_kembali = null;
            }
        
            $pinjam_mandiri->save();

            // Redirect ke halaman sebelumnya atau halaman yang sesuai
            return redirect()->route('pinjam-mandiri');
        }

        // perpanjang
        public function PerpanjangMandiri($id)
        {
        $pinjam_mandiri = PpMandiri::findOrFail($id);

        // Jika peminjaman sudah dikembalikan, tidak bisa dilakukan perpanjangan
        if ($pinjam_mandiri->status) {
            return redirect('/peminjamandanpengembalian-mandiri')->with('error', 'Peminjaman sudah dikembalikan, tidak bisa melakukan perpanjangan.');
        }

        // Hitung tanggal perpanjangan peminjaman (tambahkan 3 hari dari tanggal pengembalian sebelumnya)
        $tgl_perpanjang = Carbon::parse($pinjam_mandiri->tgl_kembali)->addDays(3);

        // Pastikan tanggal perpanjangan tidak melebihi tanggal saat ini
        $tgl_perpanjang = $tgl_perpanjang->isPast() ? Carbon::now() : $tgl_perpanjang;

        // Update tanggal_pengembalian dengan tanggal perpanjangan
        $pinjam_mandiri->tgl_perpanjang = $tgl_perpanjang;
        $pinjam_mandiri->save();

        return redirect('/peminjamandanpengembalian-mandiri')->with('success', 'Peminjaman berhasil diperpanjang.');
        }
 
        
         /*delete*/
        public function DeletePeminjamanMandiri($id){
            $pinjam_mandiri = PpMandiri::find($id);
            $pinjam_mandiri-> delete();
            return redirect()->route('pinjam-mandiri');
        }


    /*PPKolektif*/
    public function PeminjamandanPengembalianKolektif()
    {
        $judul_buku = Databuku::get();
        // dd($judul_buku);
        $pp_kolektif = PpKolektif::all();

        
        return view('peminjamandanpengembalian-kolektif',compact('judul_buku','pp_kolektif'));

    }

        /*create*/
        public function TambahPeminjamanKolektif(Request $request)
        {
            $pinjam_kolektif = PpKolektif::create($request->all());
            // dd($request->all);
            return redirect()->route('pinjam-kolektif');
        }

        // kembalikan
        public function KembalikanKolektif($id)
        {
            // Cari peminjaman berdasarkan ID
            $pinjam_kolektif = PpKolektif::findOrFail($id);

            // Ubah status menjadi "dikembalikan"
            $pinjam_kolektif->status = !$pinjam_kolektif->status;
            $pinjam_kolektif->save();

            // Redirect ke halaman sebelumnya atau halaman yang sesuai
            return redirect()->route('pinjam-kolektif');
        }

        /*delete*/
        public function DeletePeminjamanKolektif($id){
            $pinjam_kolektif = PpKolektif::find($id);
            $pinjam_kolektif-> delete();
            return redirect()->route('pinjam-kolektif');
        }


    public function Laporan()
    {
        return view('laporan');
    }
}
