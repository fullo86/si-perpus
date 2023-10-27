@extends('layouts/main')
@section('title', 'Halaman Buku')
    
@section('books')    
<h1 class="text-center">DATA BUKU</h1>
    @if (Auth::user()->role_id == 1)
        <a href="create/book" class="btn btn-primary mb-3">Tambah Buku</a>    
    @endif
    @if (Session::has('status'))
        <div class="alert alert-success">
            {{Session::get('message')}}
        </div>
    @endif
<div class="row">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            {{-- <th scope="col">Kode Buku</th> --}}
            <th scope="col">Judul</th>
            <th scope="col">Pengarang</th>
            <th scope="col">Penerbit</th>
            {{-- <th scope="col">Kategori</th>
            <th scope="col">Gambar</th>
            <th scope="col">Status</th> --}}
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($listBooks as $row)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                {{-- <td>{{$row->book_code}}</td> --}}
                <td>{{$row->title}}</td>
                <td>{{$row->author}}</td>
                <td>{{$row->publisher}}</td>
                {{-- <td>
                    @foreach ($row->categories as $category)
                        {{$category->category_name}} <br>
                    @endforeach
                </td>
                <td><img src="{{ asset('storage/images/'.$row->image_book) }}" alt="image" width="100px" height="100px"></td>
                <td>{{$row->status}}</td> --}}
                <td>
                    <a href="/show/book/{{$row->slug}}" class="badge rounded-pill text-bg-warning text-decoration-none">Detail</a>
                    @if (Auth::user()->role_id == 1)
                    <a href="/edit/book/{{$row->slug}}" class="badge rounded-pill text-bg-primary text-decoration-none">Ubah</a>
                    <form action="delete-book/{{ $row->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge rounded-pill text-bg-danger border-0" onclick="return confirm('Yakin Mau Hapus?')">Hapus</button>
                    </form>
                    @endif
              </td>
            </tr>                    
            @endforeach
        </tbody>
      </table>
</div>
@endsection