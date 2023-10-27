@extends('layouts/main')
@section('title', 'Halaman Stok Buku')
    
@section('stock')
<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}
<h1 class="text-center mb-5">DATA STOK BUKU</h1>
    @if (Session::has('status'))
        <div class="alert alert-success">
            {{Session::get('message')}}
        </div>
    @endif
<div class="row">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Stok</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($stockBooks as $row)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$row->title}}</td>
                <td>{{$row->stock}}</td>
                <td class="fw-bold {{$row->stock > 0  ? 'text-success' : 'text-danger'}}">{{$row->status}}</td>
                <td>
                    <a href="#" class="btn-mdf badge rounded-pill text-bg-primary border-0" style="text-decoration: none" data-bs-toggle="modal" data-bs-target="#dataModal" data-id="{{$row->id}}" data-stock="{{$row->stock}}" data-status="{{$row->status}}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>

<!-- Modal -->
<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="dataModalLabel">Tambah Stok Buku</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/book/add-stock/save" method="post">
                @csrf
                <input type="hidden" name="book_id" id="bookId">
                <div class="form-group">
                    <input type="text" class="form-control" name="stock" id="stock" placeholder="Masukan Stok">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  
  <script>
    $('.btn-mdf').on('click', function() {
        let bookId = $(this).data('id');
        let stock = $(this).data('stock');
        $('#bookId').val(bookId);
        $('#stock').val(stock);
    });

    $('#saveChanges').on('click', function() {
        let bookId = $('#bookId').val();
        let newStock = $('#stock').val();

        $.ajax({
            url: '#',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                book_id: bookId,
                stock: newStock
            },
            success: function(response) {
                console.log(response);
                $('#dataModal').modal('hide'); // Tutup modal setelah berhasil
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });
</script>
@endsection