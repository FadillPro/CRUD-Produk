<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Import Model Produk
use App\Models\JenisProduk; // Import Model JenisProduk
use Illuminate\Support\Facades\Auth; // Untuk cek role

class ProdukController extends Controller
{
    
    public function index()
    {
        
        $produks = Produk::with('jenisProduk')->get();

        $userRole = Auth::user()->role;
        $isAdmin = ($userRole === 'admin');
        $isStaff = ($userRole === 'staff');

       
        return view('produk.index', compact('produks', 'isAdmin', 'isStaff'));
    }

   
    public function create()
    {
      
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi: Hanya Admin yang dapat menambah Produk.');
        }

        
        $jenis_produks = JenisProduk::all();
        
        return view('produk.create', compact('jenis_produks'));
    }

    
    public function store(Request $request)
    {
        
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Dibatasi: Hanya Admin yang dapat menambah Produk.');
        }

        
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'jenis_produk_id' => 'required|exists:jenis_produks,id', 
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        $jenis_produks = JenisProduk::all();
        $userRole = Auth::user()->role;
        
       
        return view('produk.edit', compact('produk', 'jenis_produks', 'userRole'));
    }

    
    public function update(Request $request, Produk $produk)
    {
        $userRole = Auth::user()->role;

        if ($userRole === 'admin') {
            $validated = $request->validate([
                'nama_produk' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'harga' => 'required|integer|min:0',
                'jenis_produk_id' => 'required|exists:jenis_produks,id',
            ]);
            
            $produk->update($validated);

        } elseif ($userRole === 'staff') {
            $validated = $request->validate([
                'harga' => 'required|integer|min:0',
            ]);

           
            $produk->update(['harga' => $validated['harga']]);

        } else {
            abort(403, 'Akses Dibatasi.');
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

   
    public function destroy(Produk $produk)
    {
        
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya Admin yang dapat menghapus Produk.');
        }
        
        $produk->delete();
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}