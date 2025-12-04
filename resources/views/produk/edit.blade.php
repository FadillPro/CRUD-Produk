@extends('layouts.main')

@section('title', 'Edit Produk')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Edit Produk: {{ $produk->nama_produk }}</h2>

        <a href="{{ route('produk.index') }}" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block">← Kembali ke Daftar Produk</a>

        {{-- Logika untuk menentukan apakah field harus di-disabled --}}
        @php
            $isStaff = ($userRole === 'staff');
            $disabledAttr = $isStaff ? 'disabled' : '';
        @endphp

        <form action="{{ route('produk.update', $produk) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Nama Produk (Disabled jika Staff) --}}
            <div class="mb-4">
                <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required {{ $disabledAttr }}>
                @error('nama_produk')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
                @if ($isStaff)
                    
                @endif
            </div>

            {{-- Deskripsi (Disabled jika Staff) --}}
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required {{ $disabledAttr }}>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga (SELALU AKTIF untuk Admin dan Staff) --}}
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Integer)</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                @error('harga')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dropdown Jenis Produk (Disabled jika Staff) --}}
            <div class="mb-6">
                <label for="jenis_produk_id" class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                <select name="jenis_produk_id" id="jenis_produk_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required {{ $disabledAttr }}>
                    @foreach ($jenis_produks as $jenis)
                        <option value="{{ $jenis->id }}" {{ old('jenis_produk_id', $produk->jenis_produk_id) == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_produk_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Update Produk
            </button>
        </form>
    </div>
@endsection