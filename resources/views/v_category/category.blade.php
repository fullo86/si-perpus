@extends('layouts/main')
@section('title', 'Halaman Kategori')
    
@section('categories')
<h1 class="text-center">DATA KATEGORI</h1>
@if (Auth::user()->role_id == 1)
<a href="create/category" class="btn btn-primary mb-3">Tambah Kategori</a>    
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
            <th scope="col">Nama Kategori</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($listCategory as $row)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$row->category_name}}</td>
                <td>
                    <a href="#" class="badge rounded-pill text-bg-warning text-decoration-none">Detail</a>
                    @if (Auth::user()->role_id == 1)
                    <a href="/edit/category/{{$row->slug}}" class="badge rounded-pill text-bg-primary text-decoration-none">Ubah</a>
                    <form action="delete-category/{{ $row->id }}" method="post" class="d-inline">
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