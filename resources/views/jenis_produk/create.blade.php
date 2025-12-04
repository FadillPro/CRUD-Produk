@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h2>Tambah Jenis Produk</h2>

        <a href="{{ route('jenis_produk.index') }}" class="btn btn-secondary mb-3">Kembali</a>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jenis_produk.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="nama_jenis">Nama Jenis Produk:</label>
                    
                        <input type="text" 
                               name="nama_jenis" 
                               id="nama_jenis" 
                               class="form-control @error('nama_jenis') is-invalid @enderror" 
                               value="{{ old('nama_jenis') }}" 
                               required>
                        
                        @error('nama_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection