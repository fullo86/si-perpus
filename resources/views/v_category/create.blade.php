@extends('layouts/main')
@section('title', 'Tambah Kategori')

@section('add-category')
<h1 class="text-center">TAMBAH KATEGORI</h1>
    <div class="row mt-5">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>                    
        @endif
        <form method="POST" action="/create-category/save">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label"></label>
                <input id="nama" class="form-control" type="text" name="category_name" placeholder="Masukan Nama Kategori" required>
            </div>
            <div class="justify-content-between d-flex">
                <div class="col-6">
                    <a href="/category" class="btn btn-primary col-11">Batal</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-12" style="margin-right: auto;">Tambah</button>    
                </div>
            </div>
        </form>                
    </div>
</div>
@endsection