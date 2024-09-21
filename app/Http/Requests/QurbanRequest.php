<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QurbanRequest extends FormRequest
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
            'tahun_qurban' => 'required',
            'tanggal_pembukaan' => 'required',
            'tanggal_penutupan' => 'required',
            'status' => 'required',
            'keterangan' => 'required'
        ];
    }
    // pesan kesalahan validasi
    public function messages()
    {
        return [
            'tahun_qurban.required' => 'Masukan tahun progam qurban',
            'tanggal_pembukaan.required' => 'Masukan tanggal pembukaan pendaftaran qurban',
            'tanggal_penutupan.required' => 'Masukan tanggal Penutupan pendaftaran qurban',
            'status.required' => 'Masukan status pendaftaran qurban',
            'keterangan.required' => 'Masukan keterangan program qurban!'
        ];
    }
}
