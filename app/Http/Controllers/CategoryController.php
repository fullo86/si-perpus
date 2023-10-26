<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('v_category/category', ['listCategory' => $data]);
    }

    public function create()
    {
        return view('v_category/create');
    }

    public function store(CategoryRequest $request)
    {
        $request->validate([
            'category_name' => 'unique:categories'
        ]);

        Category::create($request->all());
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menambahkan Kategori Baru');
        return redirect('/category');
    }

    public function edit($slug)
    {
        $dataCategory = Category::where('slug', $slug)->first();
        return view('v_category/edit', ['categoryValue' => $dataCategory]);
    }

    public function update(CategoryRequest $request, $slug)
    {
        $updateData = Category::where('slug', $slug)->first();
        $updateData->slug = null;
        $updateData->update($request->all());

        if (!$updateData) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Mengupdate Data Kategori');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data Kategori');
        return redirect('/category');
    }

    public function destroy($id)
    {
        $removeCategory = Category::findOrFail($id);
        $removeCategory->delete();

        if (!$removeCategory) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Kategori');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Kategori');
        return redirect('/category');
    }

}
