@extends('layouts/main')
@section('title', 'Beranda')
    
@section('books-list')
    <form action="" method="get">
        <div class="row">
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="#" selected disabled>Pilih Kategori</option>
                    @foreach ($categoryData as $value)
                        <option value="{{$value->category_name}}">{{$value->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan Keyword" name="keyword" id="keyword">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
    <h1 class="text-center mt-5">Daftar Buku</h1>
    <div class="row mx-auto mt-5">
        @foreach ($listBooks as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/images/'.$book->image_book) }}" class="card-img-top" alt="image" width="200px" height="350px" draggable="false">
                <div class="card-body">
                    <h5 class="card-title">{{$book->book_code}}</h5>
                    <p class="card-text">{{$book->title}}</p>
                    <p class="card-text text-end fw-bold {{$book->status == 'in stock' ? 'text-success' : 'text-danger'}}">{{$book->status}}</p>
                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>        
</div>        
@endsection
