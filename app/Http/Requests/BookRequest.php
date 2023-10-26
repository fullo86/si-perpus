<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       => 'required|max:99',
            'author'      => 'required|max:50',
            'publisher'   => 'required|max:50',
            'image_book'  => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG',
        ];
    }

    public function messages()
    {
        return [
            'title.required'      => 'Judul Harus Diisi',
            'title.max'           => 'Judul Terlalu Panjang',
            'author.required'     => 'Nama Pengarang Harus Diisi',
            'author.max'          => 'Nama Pengarang Terlalu Panjang',
            'publisher.required'  => 'Nama Penerbit Harus Diisi',
            'publisher.max'       => 'Nama Penerbit Terlalu Panjang',
            'image_book.required' => 'Gambar Buku Harus Diisi',
            'image_book.mimes'    => 'Format Gambar Tidak Didukung',
        ];
    }
}
