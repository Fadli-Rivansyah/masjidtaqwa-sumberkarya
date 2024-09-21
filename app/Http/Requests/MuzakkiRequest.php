<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuzakkiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_muzakki' => 'required|max:10',
            'telepon_muzakki' => 'required',
            'tanggal_muzakki' => 'required',
            'jumlah_muzakki' => 'required|integer|min:0',
            'kategori_muzakki' => 'required',
            'jumlah_zakat' => 'required|integer|min:0'
        ];
    }
    // pesan kesalahan
    public function messages()
    {
        return [
            'nama_muzakki.required' => 'Masukan nama muzakki',
            'telepon_muzakki.required' => 'Isi dengan benar',
            'tanggal_muzakki.required' => 'Masukan tanggal pemberian',
            'jumlah_muzakki.required' => 'Masukan jumlah muzakki',
            'jumlah_muzakki.min' => 'Masukan jumlah dengan benar',
            'editKategori_muzakki.required' => 'Masukan kategori zakat',
            'jumlah_zakat.required' => 'Masukan jumlah zakat',
            'jumlah_zakat.min' => 'Masukan jumlah zakat dengan benar',
        ];
    }
}
