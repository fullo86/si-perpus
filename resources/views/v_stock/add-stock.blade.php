{{-- @extends('layouts/main')
@section('title', 'Halaman Stock Buku')
    
@section('stock')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <h1 class="mb-5 text-center">FORM PEMINJAMAN BUKU</h1>
        @if (Session::has('status'))
            <div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                {{ Session::get('message') }}
            </div>
        @endif
        {{$stockBooks}}
        <form action="/activity/save" method="post">
            @csrf
            <div class="mb-3">
                <label for="book" class="form-label">Buku</label>
                <select name="book" id="book" class="form-control select-mdf">
                    <option value="#" selected disabled>Pilih Buku</option>
                    @foreach ($stockBooks as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="text" class="form-control" name="stock" id="stock" placeholder="Masukan Jumlah Stok" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </div>    
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-mdf').select2();
    });
</script>
@endsection --}}
