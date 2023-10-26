@extends('layouts/main')
@section('title', 'Dashboard Admin')
    
@section('dashboard')
    <h1 class="mb-3">Selamat Datang {{Auth::user()->name}}</h1>
    <div class="row">
        <div class="col-lg-4 mb-3">
            <div class="card card-db" style="background: orchid">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journal"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">Buku</div>
                        <div class="card-count">{{$totalBooks}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="card card-db" style="background: slateblue">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list-task"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">Kategori</div>
                        <div class="card-count">{{$totalCategories}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-db" style="background: darksalmon">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people-fill"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">Member</div>
                        <div class="card-count">{{$totalUsers}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <h1>Riwayat Peminjaman Anggota</h1>
        <x-logs-table :logsData='$listData' :showNoColumn="false"/>
    </div>
@endsection