<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShohibulqurbanRequest extends FormRequest
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
            'nama_shohibul' => 'required',
            'telepon_shohibul' => 'required',
            'metode_qurban' => 'required',
            'jenis_hewan' => 'required',
            'jumlah_dana' => 'required|integer|min:0',
            'alamat_shohibul' => 'required'
        ];
    }
    // pesan kesalahan
    public function messages()
    {
        return [
            'nama_shohibul.required' => 'Berikan nama peserta qurban',
            'telepon_shohibul.required' => 'Berikan no telepon peserta qurban',
            'metode_qurban.required' => 'Berikan metode qurban',
            'jenis_hewan.required' => 'Berikan jenis qurban',
            'jumlah_dana.required' => 'Berikan jumlah dana',
            'jumlah_dana.min' => 'Berikan jumlah dana yang benar',
            'alamat_shohibul.required' => 'Berikan alamat shohibul'
        ];
    }
}
