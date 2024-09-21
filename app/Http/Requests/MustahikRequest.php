<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MustahikRequest extends FormRequest
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
            'nama_mustahik' => 'required|string',
            'tanggal_mustahik' => 'required',
            'telepon_mustahik' => 'required',
            'jenis_asnaf' => 'required',
            'alamat_mustahik' => 'required',
        ];
    }
    // pesan kesalahan
    public function messages()
    {
        return [
            'nama_mustahik.required' => 'Harap isikan nama mustahik.',
            'nama_mustahik.string' => 'Nama mustahik harus berupa teks.',
            'tanggal_mustahik.required' => 'Masukan tanggal pendaftaran.',
            'telepon_mustahik.nullable' => 'Nomor telepon mustahik tidak wajib diisi.',
            'jenis_asnaf.required' => 'Harap pilih jenis asnaf.',
            'alamat_mustahik.required' => 'Harap isikan alamat mustahik.',
        ];
    }
}
