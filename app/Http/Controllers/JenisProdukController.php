<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Wajib diimport
use App\Models\JenisProduk; 
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    // Hapus atau abaikan __construct() yang berisi middleware jika error

    public function index()
    {
        // ... Logika index tetap sama, tidak dibatasi
        $jenis_produks = JenisProduk::all();
        $isAdmin = Auth::check() && Auth::user()->role === 'admin';
        return view('jenis_produk.index', compact('jenis_produks', 'isAdmin'));
    }

    public function create()
    {
        // Pembatasan Akses CRUD (Langkah 3)
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi: Hanya Admin yang dapat menambah data.');
        }
        return view('jenis_produk.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi: Hanya Admin yang diizinkan.');
        }
        
        // ... Logika store dan validasi ...
        $request->validate(['nama_jenis' => 'required|unique:jenis_produks,nama_jenis']);
        JenisProduk::create($request->all());
        return redirect()->route('jenis_produk.index')->with('success', 'Jenis Produk berhasil ditambahkan!');
    }

    public function edit(JenisProduk $jenis_produk)
    {
        // Pembatasan Akses CRUD
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi: Hanya Admin yang dapat mengedit data.');
        }
        return view('jenis_produk.edit', compact('jenis_produk'));
    }

    // ... dan terapkan logika yang sama pada method update dan destroy
    public function update(Request $request, JenisProduk $jenis_produk)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi.');
        }
        // ... Logika update ...
    }

    public function destroy(JenisProduk $jenis_produk)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi.');
        }
        // ... Logika destroy ...
    }
}