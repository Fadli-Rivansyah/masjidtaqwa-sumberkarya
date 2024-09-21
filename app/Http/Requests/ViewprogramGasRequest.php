<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViewprogramGasRequest extends FormRequest
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
            'nama' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'telepon' => 'required',
            'jumlah' => 'required'
        ];
    }
    // pesan kesalahan
    public function messages(): array
    {
        return [
            'nama.required' => 'Berikan nama jamaah!',
            'tanggal.required' => 'Berikan tanggal transaksi jamaah!',
            'status.required' => 'Berikan status transaksi jamaah!',
            'telepon.required' => 'Berikan telepon jamaah!',
            'jumlah.required' => 'Berikan jumlah infaq jamaah!',
        ];
    }
}
