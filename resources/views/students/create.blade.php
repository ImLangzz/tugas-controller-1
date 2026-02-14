@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Siswa - Perpustakaan</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/students">
        @csrf
        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>Kelas</label>
            <input type="text" name="class" value="{{ old('class') }}" required>
        </div>
        <div>
            <label>Buku Dipinjam (pisahkan dengan koma)</label>
            <input type="text" name="borrowed_books" value="{{ old('borrowed_books') }}">
        </div>
        <div>
            <button type="submit">Simpan</button>
            <a href="/students">Kembali</a>
        </div>
    </form>
</div>
@endsection
