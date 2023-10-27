@extends('layouts/main')
@section('title', 'Tambah Buku')
    
@section('add-book')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <h1 class="text-center">TAMBAH BUKU</h1>
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/create-book/save" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label for="title" class="form-label">Judul</label>
            <input type="text" id="title" class="form-control" name="title" placeholder="Masukan Judul Buku" required>
        </div>
        <div class="mb-2">
            <label for="author" class="form-label">Pengarang</label>
            <input type="text" id="author" class="form-control" name="author" placeholder="Masukan Nama Pengarang" required>
        </div>
        <div class="mb-2">
            <label for="publisher" class="form-label">Penerbit</label>
            <input type="text" id="publisher" class="form-control" name="publisher" placeholder="Masukan Nama Penerbit" required>
        </div>
        <div class="mb-2 mt-3">
            <label for="category" class="form-label">Pilih Kategori</label>
            <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                @foreach ($listCategory as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="formFile" class="form-label mt-2">Foto Buku</label>
            <input class="form-control" type="file" name="image_book" id="image_book">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>
@endsection
