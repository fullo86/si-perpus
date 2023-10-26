@extends('layouts/main')
@section('title', 'Halaman Riwayat Peminjaman')
    
@section('logs')
<h1 class="text-center">RIWAYAT PEMINJAMAN ANGGOTA</h1>
<div class="mt-5">
    <div class="mt-5">
        <x-logs-table :logsData='$listData'/>
    </div>
</div>
@endsection