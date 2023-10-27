<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    public function index()
    {
        $booksStock = Book::select('id', 'title', 'stock', 'status')->get();

        return view('v_stock/stock', ['stockBooks' => $booksStock]);        
    }

    public function store(Request $request)
    {

        $bookId = $request->input('book_id');
        $newStock = $request->input('stock');

        $book = Book::find($bookId);
        if ($book) {
            $book->stock = $newStock;

        if ($newStock > 0) {
            $book->status = 'in stock';
        } else {
            $book->status = 'out of stock';
        }

            $book->save();
            Session::flash('status', 'success');
            Session::flash('message', 'Stok Buku Berhasil Diupdate');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Stok Buku Gagal Diupdate');
        }

        return redirect('/book/stock');
    }
}
