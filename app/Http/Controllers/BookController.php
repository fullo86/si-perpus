<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::all();

        return view('v_book/books', ['listBooks' => $data]);
    }

    public function show($slug)
    {
        $showBook = Book::where('slug', $slug)->first();

        return view('v_book/show', ['showDataBook' => $showBook]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('v_book/create', ['listCategory' => $categories]);
    }

    public function store(BookRequest $request)
    {
        $newName = '';
        if ($request->file('image_book')) {
            $extension = $request->file('image_book')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image_book')->storeAs('public/images', $newName);
        }

        $code_book = Str::random(8);
        $result_cdbk = strtoupper($code_book);
        $data = $request->all();
        $data['image_book'] = $newName;
        $data['book_code']  = $result_cdbk;

        $newData = Book::create($data);
        $newData->categories()->sync($data['categories']);

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menambahkan Buku Baru');
        return redirect('/books');
    }

    public function edit($slug)
    {
        $dataBook = Book::where('slug', $slug)->first();
        $categories = Category::all();
        
        //get value selected category
        $selectedCategories = $dataBook->categories->pluck('id')->toArray();
        return view('v_book/edit', ['bookValue' => $dataBook, 'categoryValue' => $categories, 'selectedCategories' => $selectedCategories]);
    }

    public function update(BookRequest $request, $slug)
    {
        $updateBook = Book::where('slug', $slug)->first();
        $data = $request->all();
    
        if ($request->file('image_book')) {
            // Menghapus gambar lama jika ada
            if (file_exists(public_path('storage/images/' . $updateBook->image_book))) {
                unlink(public_path('storage/images/' . $updateBook->image_book));
            }
    
            // Mengunggah gambar yang baru
            $extension = $request->file('image_book')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image_book')->storeAs('public/images/', $newName);
    
            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_book'] = $newName;
            $data['updated_at']  = Carbon::now();
        }
    
        $updateBook->update($data);
    
        if ($request->categories) {
            $updateBook->categories()->sync($request->categories);
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data Buku');
        return redirect('/books');
    }
    
    public function listBook(Request $request)
    {
        $categories = Category::select('id', 'category_name')->get();
    
        $query = Book::query();
    
        if ($request->category) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('category_name', $request->category);
            });
        }
    
        if ($request->keyword) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->keyword . '%')
                      ->orWhere('book_code', 'like', '%' . $request->keyword . '%');
            });
        }
    
        $books = $query->paginate(12);
    
        return view('v_book/listBook', ['listBooks' => $books, 'categoryData' => $categories]);
    }
    
    
    public function destroy($slug)
    {
        $removeBook = Book::where('slug', $slug)->first();

        if ($removeBook->image_book) {
            if (file_exists(public_path('storage/images/' . $removeBook->image_book))) {
                unlink(public_path('storage/images/' . $removeBook->image_book));
            }
        }

        if (!$removeBook) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Buku');
        }

        $removeBook->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Buku');
        return redirect('/books');
    }
}
