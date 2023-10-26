@extends('layouts/main')
@section('title', 'Profile Page')
    
@section('show-member')
<div class="row">
    <h1 class="text-center">DETAIL ANGGOTA</h1>
    <div class="mt-5">
        <div class="my-3 text-center">
            <div class="rounded-circle d-inline-block">
                @if ($showMember->image_user != null)
                    <img src="{{ asset('storage/images/'.$showMember->image_user) }}" alt="" class="rounded-circle" class="rounded-circle" width="200px" height="200px">
                @else
                    <img src="{{ asset('storage/images/default.png') }}" alt="" class="rounded-circle" class="rounded-circle" width="200px" height="200px">
                @endif
            </div>
        </div>        

        <div class="col-12">
            <div class="row">
                <div class="col-5">
                    <h3 class="text-center">Data Anggota</h3>
                    <div class="mb-1">
                        <label for="name" class="form-label"></label>
                        <input type="text" class="form-control" disabled value="Nama : {{$showMember->name}}">
                    </div>
                    <div class="mb-1">
                        <label for="username" class="form-label"></label>
                        <input type="text" class="form-control" disabled value="Username : {{$showMember->username}}">
                    </div>
                    <div class="mb-1">
                        <label for="phone" class="form-label"></label>
                        <input type="text" class="form-control" disabled value="No Hp : {{$showMember->phone}}">
                    </div>
                    <div class="mb-1">
                        <label for="address" class="form-label"></label>
                        <input type="text" class="form-control" disabled value="Alamat : {{$showMember->address}}">
                    </div>
                    <div class="mb-1">
                        <label for="email" class="form-label"></label>
                        <input type="email" class="form-control" disabled value="Email : {{$showMember->email}}">
                    </div>
                    <div class="mb-1">
                        <label for="status" class="form-label"></label>
                        <input type="text" class="form-control" disabled value="Status Anggota : {{$showMember->status}}">
                    </div>
                </div>
        
                <div class="col-7">
                    <h3 class="text-center">Data Peminjaman</h3>
                    <x-logs-table :logsData='$listData' :showNoColumn="false"/>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection