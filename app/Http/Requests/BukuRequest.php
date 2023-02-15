<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            'judul' => ['required'],
            'author' => ['required'],
            'genre' => ['required'],
            'harga' => ['required'],
            'jumlah_halaman' => ['required'],
            'jumlah_buku' => ['required'],
            'gambar' => ['required'],
        ];
    }
}
