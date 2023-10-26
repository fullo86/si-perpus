@extends('layouts/main')
@section('title', 'Dashboard Member')
    
@section('dashboardUser')
<div class="row">
    <h1 class="text-center">Selamat Datang {{Auth::user()->name}}</h1>
    <div class="my-3 text-center">
        <div class="rounded-circle d-inline-block">
            @if (Auth::user()->image_user != null)
                <img src="{{ asset('storage/images/'.Auth::user()->image_user) }}" alt="" class="rounded-circle" class="rounded-circle" width="200px" height="200px">
            @else
                <img src="{{ asset('storage/images/default.png') }}" alt="" class="rounded-circle" class="rounded-circle" width="200px" height="200px">
            @endif
        </div>
    </div>        

    <div class="col-lg-6 mb-3">
        <div class="card card-db" style="background: rgb(58, 191, 224)">
            <div class="row">
                <div class="col-6"><i class="bi bi-journal"></i></div>
                <div class="col-6 d-flex flex-column justify-content-center">
                    <div class="card-desc">Buku Dipinjam</div>
                    <div class="card-count">{{$countBookRent}} Buku</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="card card-db" style="background: rgb(198, 224, 82)">
            <div class="row">
                <div class="col-6"><i class="bi bi-list-task"></i></div>
                <div class="col-6 d-flex flex-column justify-content-center">
                    <div class="card-desc">Buku Dikembalikan</div>
                    <div class="card-count">{{$countReturnBook != null ? $countReturnBook : 0}} Buku</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="row">
        <div class="col-4 mt-5">
    
            <div class="card">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Nama Lengkap : {{Auth::user()->name}}</li>
                  <li class="list-group-item">Username : {{Auth::user()->username}}</li>
                  <li class="list-group-item">No Hp : {{Auth::user()->phone}}</li>
                  <li class="list-group-item">Alamat : {{Auth::user()->address}}</li>
                  <li class="list-group-item">Email : {{Auth::user()->email}}</li>
                  <li class="list-group-item">Status Anggota : {{Auth::user()->status}}</li>
                </ul>
                <div class="card-body">
                  <a href="/edit/member/{{Auth::user()->slug}}" class="btn btn-primary form-control">Edit Data</a>
                </div>
              </div>
            </div>

        <div class="col-8 mt-2">
            <x-logs-table :logsData='$listData' :showNoColumn="false"/>
        </div>
    </div>
</div>

</div>

@endsection
