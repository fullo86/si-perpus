@extends('layouts/main')
@section('title', 'Edit Buku')
    
@section('edit-book')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h1 class="text-center">EDIT BUKU</h1>
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
    <form action="/edit-book/update/{{$bookValue->slug}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-2">
        <label for="title" class="form-label">Judul</label>
        <input type="text" id="title" class="form-control" name="title" placeholder="Masukan Judul Buku" value="{{$bookValue->title}}" required>
    </div>
    <div class="mb-2">
        <label for="author" class="form-label">Pengarang</label>
        <input type="text" id="author" class="form-control" name="author" placeholder="Masukan Nama Pengarang" value="{{$bookValue->author}}" required>
    </div>
    <div class="mb-2">
        <label for="publisher" class="form-label">Penulis</label>
        <input type="text" id="publisher" class="form-control" name="publisher" placeholder="Masukan Nama Penerbit" value="{{$bookValue->publisher}}" required>
    </div>
    <div class="mb-2 mt-3">
        <label for="category" class="form-label">Pilih Kategori</label>
        <select name="categories[]" id="category" class="form-control select-multiple" multiple>
            @foreach ($categoryValue as $category)
                <option value="{{$category->id}}" 
                    @if(in_array($category->id, $selectedCategories)) selected @endif>
                    {{$category->category_name}}
                </option>
            @endforeach
        </select>
    </div>
        <img src="{{ asset('storage/images/'.$bookValue->image_book) }}" alt="image_book" width="100px" height="150px" class="py-1">
    <div class="mb-4">
        <label for="formFile" class="form-label">Foto Buku</label>
        <input class="form-control" type="file" name="image_book" id="image_book" value="{{$bookValue->image_book}}">
    </div>
    <div class="justify-content-between d-flex">
        <div class="col-6">
            <a href="/category" class="btn btn-primary col-11">Batal</a>
        </div>
        <div class="col-6">
            <button class="btn btn-primary col-12" style="margin-right: auto;">Update</button>    
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