@extends('layouts.main')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Manajemen Produk</h2>
        
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">{{ session('error') }}</div>
        @endif

        @if ($isAdmin)
            <a href="{{ route('produk.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mb-4">
                Tambah Produk
            </a>
        @endif

        <div class="overflow-x-auto">
            <table class="table table-bordered">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($produks as $produk)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $produk->nama_produk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $produk->jenisProduk->nama_jenis }}</td> 
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                
                                @if ($isAdmin || $isStaff)
                                    <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-warning">
                                        Edit {{ $isStaff ? '' : '' }}
                                    </a>
                                @endif

                                @if ($isAdmin)
                                    <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus Produk: {{ $produk->nama_produk }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data Produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection