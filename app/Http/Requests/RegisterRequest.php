<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'      => 'required|max:50',
            'username'  => 'required|max:10',
            'password'  => 'required|max:100',
            'phone'     => 'required',
            'email'     => 'required|email:rfc',
            'address'   => 'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Nama Lengkap Harus Diisi',
            'name.max'          => 'Nama Lengkap Terlalu Panjang',
            'username.required' => 'Username Harus Diisi',
            'username.max'      => 'Username Terlalu Panjang',
            'password.required' => 'Password Harus Diisi',
            'password.max'      => 'Password Terlalu Panjang',
            'phone.required'    => 'No Hp Harus Diisi',
            'email.required'    => 'Email Harus Diisi',
            'email.email'       => 'Format Email Tidak Valid',
            'address.required'  => 'Alamat Harus Diisi',
            'address.max'       => 'Alamat Terlalu Panjang',     
        ];
    }
}
