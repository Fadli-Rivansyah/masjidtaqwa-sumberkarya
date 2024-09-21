<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZakatRequest extends FormRequest
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
            'tahun_ramadhan' => 'required',
            'tanggal_pembukaan' => 'required',
            'tanggal_penutupan' => 'required',
            'status' => 'required',
            'keterangan'=> 'required' 
        ];
    }
    // pesan kesalahan
    public function messages()
    {
       return  [
            'tahun_ramadhan.required' => 'Buat tahun tahun ramadhan ini!',
            'tanggal_pembukaan.required' => 'Buat pembukaan pembayaran zakat',
            'tanggal_penutupan.required' => 'Buat penutupan penutupan pembayaran zakat',
            'status' => 'Buat status zakat dibuka atau tidak',
            'keterangan' => 'Buat keterangan syarat zakat!',
       ];
    }
}
