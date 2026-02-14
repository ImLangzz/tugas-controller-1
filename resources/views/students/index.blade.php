@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Siswa - Perpustakaan</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <a href="/students/create">Tambah Siswa</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Buku Dipinjam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ is_array($student->borrowed_books) ? implode(', ', $student->borrowed_books) : '' }}</td>
                    <td>
                        <form method="POST" action="/students/{{ $student->id }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus siswa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
