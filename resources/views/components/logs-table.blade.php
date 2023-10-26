<div>
  @props(['logsData', 'showNoColumn' => true])
  <table class="table">
    <thead>
      <tr>
        @if ($showNoColumn)
          <th>No</th>
        @endif
        <th scope="col">Kode Peminjaman</th>
        <th scope="col">Nama Peminjam</th>
        <th scope="col">Buku</th>
        <th scope="col">Tanggal Peminjaman</th>
        <th scope="col">Tanggal Pengembalian</th>
        <th scope="col">Tanggal Pengembalian Sebenarnya</th>
        @if ($showNoColumn)
          <th>Status</th>
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach ($logsData as $row)
        <tr class="{{ is_null($row->actual_return_date) ? 'table-warning' : ($row->actual_return_date > $row->return_date ? 'table-danger' : 'table-success') }}">      
          @if ($showNoColumn)
            <th scope="row">{{$loop->iteration}}</th>
          @endif
            <td>{{$row->trx_code}}</td>
            <td>{{$row->user->name}}</td>
            <td>{{$row->book->title}}</td>
            <td>{{$row->rent_date}}</td>
            <td>{{$row->return_date}}</td>
            <td>{{$row->actual_return_date ? $row->actual_return_date : 'Belum Dikembalikan'}}</td>
            @if ($showNoColumn)
              <td>@mdo</td>
            @endif            
          </tr>                    
        @endforeach
    </tbody>
  </table>
</div>