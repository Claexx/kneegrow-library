<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Notifikasi
    public function notifikasi()
    {
        return view('admin.notifikasi');
    }

    // Pengaturan
    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    // Koleksi
    public function buku()
    {
        return view('admin.buku.index');
    }

    public function bukuTambah()
    {
        return view('admin.buku.tambah');
    }

    // Anggota
    public function anggota()
    {
        return view('admin.anggota.index');
    }

    public function anggotaTambah()
    {
        return view('admin.anggota.tambah');
    }

    // Transaksi
    public function transaksi()
    {
        return view('admin.transaksi.index');
    }

    public function transaksiTambah()
    {
        return view('admin.transaksi.tambah');
    }
}
