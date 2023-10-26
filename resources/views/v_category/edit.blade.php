@extends('layouts/main')
@section('title', 'Tambah Kategori')

@section('edit-category')
<h1 class="text-center">EDIT KATEGORI</h1>
    <div class="row mt-5">
        <form method="POST" action="/edit-category/update/{{$categoryValue->slug}}">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="nama" class="form-label"></label>
                <input id="nama" class="form-control" type="text" name="category_name" placeholder="Masukan Nama Kategori" value="{{$categoryValue->category_name}}" required>
            </div>
            <div class="justify-content-between d-flex">
                <div class="col-6">
                    <a href="/category" class="btn btn-primary col-11">Batal</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-12" style="margin-right: auto;">Edit</button>    
                </div>
            </div>
        </form>                
    </div>
</div>
@endsection