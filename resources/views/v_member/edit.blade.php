@extends('layouts/main')
@section('title', 'Edit Anggota')

@section('edit-member')
<h1 class="text-center">EDIT ANGGOTA</h1>
    <div class="row mt-5">
        <form method="POST" action="/edit-member/update/{{$memberValue->slug}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-2">
                <label for="name" class="form-label">Nama</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Masukan Nama" value="{{$memberValue->name}}" required>
            </div>
            <div class="mb-2">
                <label for="username" class="form-label">Username</label>
                <input id="username" class="form-control" type="text" name="username" placeholder="Masukan Username" value="{{$memberValue->username}}" required>
            </div>
            <div class="mb-2">
                <label for="phone" class="form-label">No Hp</label>
                <input id="phone" class="form-control" type="text" name="phone" placeholder="Masukan No Hp" value="{{$memberValue->phone}}" required>
            </div>
            <div class="mb-2">
                <label for="address" class="form-label">Alamat</label>
                <input id="address" class="form-control" type="text" name="address" placeholder="Masukan Alamat" value="{{$memberValue->address}}" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="email" name="email" placeholder="Masukan Email" value="{{$memberValue->email}}" required>
            </div>
            <img src="{{ asset('storage/images/'.$memberValue->image_user) }}" alt="image_user" width="100px" height="150px" class="py-1">
            <div class="mb-4">
                <label for="formFile" class="form-label">Profil</label>
                <input class="form-control" type="file" name="image_user" id="image_user" value="{{$memberValue->image_user}}">
            </div>
            <div class="justify-content-between d-flex">
                <div class="col-6">
                    <a href="/members" class="btn btn-primary col-11">Batal</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-12" style="margin-right: auto;">Update</button>    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection