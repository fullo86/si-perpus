@extends('layouts/main')
@section('title', 'Halaman Members')
    
@section('members')
<h1 class="text-center">DATA ANGGOTA PERPUSTAKAAN</h1>
@if (Session::has('status'))
    <div class="alert alert-success">
        {{Session::get('message')}}
    </div>
@endif
<div class="row mt-5">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">No Hp</th>
            <th scope="col">Email</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody {{$no=1}}>
            @foreach ($listMembers as $row)
                @if ($row->id != 1)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$row->username}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->email}}</td>
                        <td>
                            <a href="/show/member/{{$row->slug}}" class="badge rounded-pill text-bg-warning text-decoration-none">Detail</a>
                            <a href="/edit/member/{{$row->slug}}" class="badge rounded-pill text-bg-primary text-decoration-none">Ubah</a>
                            <form action="delete-member/{{ $row->slug }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge rounded-pill text-bg-danger border-0" onclick="return confirm('Yakin Mau Hapus?')">Hapus</button>
                            </form>
                            @if ($row->status == 'active')
                            <form action="active/member/{{$row->slug}}" method="post" class="d-inline">
                                @method('patch')
                                @csrf
                                <button class="badge rounded-pill text-bg-info border-0">Inactivated</button>
                            </form>
                            @else
                            <form action="active/member/{{$row->slug}}" method="post" class="d-inline">
                                @method('patch')
                                @csrf
                                <button class="badge rounded-pill text-bg-info border-0">Activated</button>
                            </form>                                                                
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
      </table>
</div>
@endsection
