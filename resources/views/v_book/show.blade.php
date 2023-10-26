@extends('layouts/main')
@section('title', 'Detail Buku')
    
@section('show-book')
    <div class="row">
        <h1 class="text-center">DETAIL BUKU</h1>
        <div class="my-3 text-center">
            <div class="d-inline-block">
                <img src="{{ asset('storage/images/'.$showDataBook->image_book) }}" alt="image" width="250px" height="250px">
            </div>
        </div>            
        <div class="col-lg-12 mt-5">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$showDataBook->book_code}}</td>
                        <td>{{$showDataBook->title}}</td>
                        <td>{{$showDataBook->author}}</td>
                        <td>{{$showDataBook->publisher}}</td>
                        <td>
                            @foreach ($showDataBook->categories as $category)
                                {{$category->category_name}} <br>
                            @endforeach
                        </td>
                        <td class="fw-bold {{$showDataBook->status != 'in stock' ? 'text-danger' : 'text-success'}}">{{$showDataBook->status}}</td>
                    </tr>                    
                </tbody>
              </table>        
        </div>
    </div>
@endsection