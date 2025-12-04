@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h2>Manajemen Jenis Produk</h2>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($isAdmin)
            <a href="{{ route('jenis_produk.create') }}" class="btn btn-primary mb-3">Tambah Jenis Produk</a>
        @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Jenis</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenis_produks as $jenis)
                        <tr>
                            <td>{{ $jenis->id }}</td>
                            <td>{{ $jenis->nama_jenis }}</td>
                            <td>
                                @if ($isAdmin)
                                    <a href="{{ route('jenis_produk.edit', $jenis) }}" class="btn btn-sm btn-warning">Edit</a>
                                    
                                    <form action="{{ route('jenis_produk.destroy', $jenis) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus Jenis Produk: {{ $jenis->nama_jenis }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @else
                                    
                                    <span class="text-muted">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data Jenis Produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection