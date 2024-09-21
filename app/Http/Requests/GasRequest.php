<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GasRequest extends FormRequest
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
            'nama_program' => 'required',
            'kategori_program' => 'required',
            'tanggal_program' => 'required',
            'biaya_program' => 'required|integer|min:0',
            'target_program' => 'required',
            'keterangan_program' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_program.required' => 'Berikan nama program yang akan di buat!',
            'kategori_program.required' => 'Berikan kategori berdasarakan program!',
            'tanggal_program.required' => 'Berikan tanggal mulai program dibuat!',
            'biaya_program.required' => 'Berikan biaya yang diPerlukan untuk program!',
            'biaya_program.min' => 'Berikan Biaya yang benar!',
            'target_program.required' => 'Berikan target selesai pada program yang di buat program!',
            'keterangan_program.required' => 'Berikan deskripsi tentang program!'
        ];
    }
}
