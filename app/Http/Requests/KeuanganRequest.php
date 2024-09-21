<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeuanganRequest extends FormRequest
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
            'tanggal_data'=> 'required',
            'jenis_data' => 'required',
            'kategori_data' => 'required',
            'jumlah_data' => 'required',
            'keterangan' => 'required'
        ];
    }
    //validasi pesan kesalahan
    public function messages()
    {
        return [
            'tanggal_data.required' => 'Tanggal harus diisi!',
            'jenis_data.required' => 'Jenis data harus diisi!',
            'kategori_data.required' => 'Kategori data harus diisi!',
            'jumlah_data.required' => 'jumlah data harus diisi!',
            'keterangan.required' => 'Keterangan harus diisi',
        ];
    }
}
